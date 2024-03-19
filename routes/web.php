<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\bukucontroller;
use App\Http\Controllers\kategoricontroller;
use App\Http\Controllers\koleksicontroller;
use App\Http\Controllers\peminjamancontroller;
use App\Http\Controllers\laporancontroller;
use App\Http\Controllers\berandacontroller;
use App\Http\Controllers\profilecontroller;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [berandacontroller::class, 'listbuku'])->name('list.buku');

route::group(['middleware' => ['auth', 'checkrole:admin']], function(){

    //buku
    Route::get('/buku', [bukucontroller::class, 'index'])->name('buku.index');
    Route::get('/buku/create', [bukucontroller::class, 'create'])->name('buku.create');
    Route::post('/buku', [bukucontroller::class, 'store'])->name('buku.store');
    Route::get('/buku/{id}/edit', [bukucontroller::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{id}', [bukucontroller::class, 'update'])->name('buku.update');
    Route::delete('/buku/{id}', [bukucontroller::class, 'destroy'])->name('buku.destroy');

    //kategori
    Route::get('/kategori/create', [kategoricontroller::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [kategoricontroller::class, 'store'])->name('kategori.store');
    Route::get('/kategori/show', [kategoricontroller::class, 'show'])->name('kategori.show');
    Route::get('/kategori/{id}/edit', [kategoricontroller::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [kategoricontroller::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [kategoricontroller::class, 'destroy'])->name('kategori.destroy');

    //cetak-laporan
    Route::get('/peminjaman', [peminjamancontroller::class, 'admin'])->name('admin.peminjaman');
    Route::post('/admin/peminjaman/cetak', [laporancontroller::class, 'cetakLaporan'])->name('cetak.peminjaman');
    Route::get('/pengguna', [laporancontroller::class, 'pengguna'])->name('admin.pengguna');
    Route::get('/admin/pengguna/cetak', [laporancontroller::class, 'cetakPengguna'])->name('cetak.pengguna');
});

route::group(['middleware' => ['auth', 'checkrole:user', 'verified']], function(){
    
    //buku
    Route::get('/', [berandacontroller::class, 'listbuku'])->name('list.buku');
    Route::get('buku/{id}/show', [bukucontroller::class, 'show'])->name('buku.show');
    Route::post('/ulasan/{id}', [bukucontroller::class, 'ulasanstore'])->name('ulasan.store');
    Route::post('/ulasan/{id}/create', [bukucontroller::class, 'ulasan'])->name('ulasan');
    Route::get('/buku/search', [bukucontroller::class, 'search'])->name('buku.search');
    
    //koleksi
    Route::get('/koleksi', [koleksicontroller::class, 'index'])->name('koleksi.index');
    Route::get('/koleksi/create', [koleksicontroller::class, 'create'])->name('koleksi.create');
    Route::post('/koleksi', [koleksicontroller::class, 'store'])->name('koleksi.store');
    Route::delete('/koleksi/{id}', [koleksicontroller::class, 'destroy'])->name('koleksi.destroy');
    
    //peminjaman
    Route::get('/pinjam', [peminjamancontroller::class, 'index'])->name('pinjam.index');
    Route::get('/pinjam/create/{id}', [peminjamancontroller::class, 'create'])->name('pinjam.create');
    Route::post('/pinjam/{id}', [peminjamancontroller::class, 'store'])->name('pinjam.store');
    Route::post('/pengembalian/{id}', [peminjamancontroller::class, 'pengembalian'])->name('pengembalian');

    //profile
    Route::get('/profile', [profilecontroller::class, 'index'])->name('profile.index');
    Route::put('/profile/{id}', [profilecontroller::class, 'update'])->name('profile.update');

});    



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
