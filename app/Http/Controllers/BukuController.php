<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $batas = 5;
        $data_buku = Buku::orderBy('id','desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        // Menghitung jumlah total data buku
        $jumlah_buku = $data_buku->count();
        // Menghitung total harga semua buku
        $total_harga = $data_buku->sum('harga');

        $isAuthenticated = Auth::check();

        return view('buku.index', compact('batas', 'no','data_buku', 'jumlah_buku', 'total_harga','isAuthenticated'));
    }


    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $buku = new Buku();
    //     $buku->judul = $request->judul;
    //     $buku->penulis = $request->penulis;
    //     $buku->harga = $request->harga;
    //     $buku->tahun_terbit = $request->tahun_terbit;
    //     $buku->save();

    //     return redirect('/buku/index');

    // }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tahun_terbit' => 'required|date',
        ],

        [
            'judul.required' => 'Kamu harus mengisi judul terlebih dahulu',
            'judul.string' => 'judul harus diisi data bertipe string',
            'penulis.required' => 'Kamu harus mengisi penulis terlebih dahulu',
            'penulis.string' => 'Penulis harus diisi data bertipe string',
            'penulis.max' => 'Penulis maksimal 30 karakter',
            'harga.required' => 'Kamu harus mengisi harga terlebih dahulu',
            'harga.numeric' => 'Harga harus diisi data bertipe nomor',
            'tahun_terbit.required' => 'Kamu harus mengisi tanggal terbit terlebih dahulu',
            'tahun_terbit.date' => 'Tanggal terbit harus diisi data bertipe tanggal'
        ]);
        $buku = new Buku();
        $buku -> judul = $request -> judul;
        $buku -> penulis = $request -> penulis;
        $buku -> harga = $request -> harga;
        $buku -> tahun_terbit = $request -> tahun_terbit;
        $buku -> save();

        return redirect('/buku/index')-> with('successadd', 'Item added successfuly');
    }

    public function search(Request $request)
    {
        $batas = 5;

        $cari = $request->kata;

        $data_buku = Buku::where('judul','like',"%".$cari."%")->paginate($batas);

        $no = $batas * ($data_buku->currentPage() - 1);

        $count = $data_buku->count();
        $isAuthenticated = Auth::check();

        return view('buku.search', compact('no', 'data_buku', 'count', 'cari','isAuthenticated'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        // dd($buku);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {

    //     $buku = Buku::find($id);
    //     $buku->judul = $request->judul;
    //     $buku->penulis = $request->penulis;
    //     $buku->harga = $request->harga;
    //     $buku->tahun_terbit = $request->tahun_terbit;
    //     $buku->save();

    //     return redirect('/buku/index') -> with('successedit', 'Item updated successfuly');
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tahun_terbit' => 'required|date',
        ]);
        $buku = Buku::find($id);
        $buku -> judul = $request -> input('judul');
        $buku -> penulis = $request -> input('penulis');
        $buku -> harga = $request -> input('harga');
        $buku -> tahun_terbit = $request -> input('tahun_terbit');
        $buku -> save();

        return redirect('/buku/index') -> with('successedit', 'Item updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku/index') -> with('successdel', 'Item deleted successfuly');

    }
}
