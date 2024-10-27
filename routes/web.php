<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\BukuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
   });




   Route::middleware('auth')->group(function() {
    Route::controller(BukuController::class)->group(function() {
        Route::get('/buku/create', 'create')->name('buku.create');
        Route::post('/buku', 'store')->name('buku.store');
        Route::delete('/buku/{id}', 'destroy')->name('buku.destroy');
        Route::get('/buku/edit/{id}', 'edit')->name('buku.edit');
        Route::put('/buku/{id}', 'update')->name('buku.update');
    });
});

Route::controller(BukuController::class)->group(function() {
    Route::get('/buku/index', 'index')->name('buku.index');
    Route::get('/buku/create', 'create')->name('buku.create');
    Route::post('/buku', 'store')->name('buku.store');
    Route::delete('/buku/{id}', 'destroy')->name('buku.destroy');
    Route::get('/buku/edit/{id}', 'edit')->name('buku.edit');
    Route::put('/buku/{id}', 'update')->name('buku.update');
    Route::get('/buku/search', 'search')->name('buku.search'); // Tambahkan ini jika belum ada
});

