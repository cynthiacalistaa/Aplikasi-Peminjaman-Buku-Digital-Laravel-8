<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\buku;
use App\koleksi;
use App\peminjaman;
use App\ulasan;
use Illuminate\Support\Facades\Auth;

class koleksicontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $jumlahPeminjaman = Peminjaman::where('buku_id')->count();
            $jumlahUlasan = Ulasan::where('buku_id')->count();
            
            $koleksiBuku = Koleksi::where('users_id', $user->id)->with('buku')->get();

            return view('buku.koleksi', compact('koleksiBuku', 'jumlahPeminjaman', 'jumlahUlasan'));
        } else {
            return redirect()->route('login')->with('warning', 'Anda harus login untuk melihat koleksi.');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('koleksi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $buku = Buku::findOrFail($request->input('id'));
    $buku->isInKoleksi = true;
    $user = auth()->user();

    $koleksi = Koleksi::firstOrCreate([
        'users_id' => $user->id,
        'buku_id' => $buku->id,
    ]);

    if ($koleksi->wasRecentlyCreated) {
        return redirect()->route('koleksi.index')->with('success', 'Book added to collection successfully!');
    } else {
        return redirect()->route('buku.show')->with('info', 'Book is already in the collection!');
    }
}




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        koleksi::where('id', $id)->delete();
        return redirect(route('koleksi.index'))->with(['Success' => 'koleksi berhasil dihapus!']);
    }
}
