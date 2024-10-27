<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan hanya pengguna yang belum login yang dapat mengakses halaman login dan register
        $this->middleware('guest')->except([
            'logout',
            'dashboard'
        ]);
    }

    // Menampilkan halaman registrasi
    public function register()
    {
        return view('auth.register');
    }

    // Menyimpan data registrasi dan melakukan login
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|unique:users|max:250',
            'password' => 'required|confirmed|min:8'
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Login otomatis setelah registrasi
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();

        // Mengarahkan ke halaman buku.index
        return redirect()->route('buku.index')->with('success', 'You have successfully registered and logged in');
    }

    // Menampilkan halaman login
    public function login()
    {
        return view('auth.login');
    }

    // Memproses login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Melakukan autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('buku.index')->with('success', 'You have successfully logged in');
        }

        // Jika autentikasi gagal, kembali ke halaman login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records'
        ])->onlyInput('email');
    }

    // Menghandle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mengarahkan kembali ke halaman buku.index setelah logout
        return redirect()->route('buku.index')->with('success', 'You have successfully logged out');
    }

    // Menampilkan halaman dashboard
    public function dashboard()
    {
        // Mengecek apakah pengguna sudah login
        if (Auth::check()) {
            return redirect()->route('buku.index');
        }

        // Jika belum login, arahkan ke halaman login
        return redirect()->route('login')->withErrors([
            'email' => 'Please login to access this page'
        ])->onlyInput('email');
    }
}
