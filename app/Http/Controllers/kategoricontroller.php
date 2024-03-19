<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kategori;
use App\buku;
use Illuminate\Support\Facades\Storage;

class kategoricontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori::all();
        return view('kategori.create', compact('kategori'));
    }

    public function show(){
        $kategori = kategori::all();
        $buku = buku::all();
        return view('kategori.show', compact('kategori', 'buku'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'namakategori' => 'required|string|max:255|unique:tb_kategoribuku',
        ]);

        $kategori = new kategori();


        $kategori->namakategori = $request->namakategori;


        $kategori->save();

        return redirect()->route('kategori.create')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = kategori::where('id', $id)->first();
        return view('kategori.edit', compact('kategori'));
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
        $request->validate([
            'namakategori' => 'required|string|max:255'
        ]);

        $kategori = kategori::findOrFail($id);
        $kategori->update([
            'namakategori' => $request->namakategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        kategori::where('id', $id)->delete();
        return redirect()->route('kategori.create')->with(['Success' => 'Kategori berhasil dihapus!']);
    }
}
