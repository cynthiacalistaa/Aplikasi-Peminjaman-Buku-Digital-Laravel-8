<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\buku;
use App\kategori;
use App\ulasan;
use App\peminjaman;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class bukucontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = kategori::all();
        $buku = buku::all();
        return view('buku.index', compact('buku', 'kategori'));
    }

    public function search(Request $request)
{
    $query = Buku::query();

        if ($request->has('judul')) {

            $query->where('judul', 'like', '%' . $request->input('judul') . '%');
        }

        // Filter berdasarkan kategori buku jika dipilih
        if ($request->has('kategori')) {
            $query->where('kategori_id', 'like', '%' . $request->input('kategori'));
        }

        $kategori = kategori::all();
        $users_id = Auth::id();
        $buku = $query->with(['koleksipribadi', 'peminjaman' => function ($query) use ($users_id) {
            $query->where('users_id', $users_id);
        }])->get();


        return view('buku.show', compact('kategori', 'buku', 'users_id'));
}




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori::all();
        return view('buku.create', compact('kategori'));
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
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul' => 'required',
            'kategori_id' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahunterbit' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
        ]);


        $buku = new buku();

        if ($request->hasFile('image')) {
            if ($buku->foto) {
                Storage::delete('public/' . $buku->foto);
            }

            $fotoPath = $request->file('image')->store('public/foto_buku');
            $buku->foto = str_replace('public/', '', $fotoPath);
        }

        $buku->foto = $fotoPath;
        $buku->judul = $request->judul;
        $buku->kategori_id = $request->kategori_id;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahunterbit = $request->tahunterbit;
        $buku->stok = $request->stok;
        $buku->deskripsi = $request->deskripsi;

        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = buku::findOrFail($id);
        $jumlahPeminjaman = Peminjaman::where('buku_id', $id)->count();
        $jumlahUlasan = ulasan::where('buku_id', $id)->count();
        $ulasan = ulasan::where('buku_id', $id)->get();
        return view('buku.show', compact('buku', 'jumlahPeminjaman', 'jumlahUlasan', 'ulasan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::find($id);
        $kategori = kategori::all();
        return view('buku.edit', compact('kategori', 'buku'));
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

        $buku = buku::findOrFail($id);

        $buku->judul = $request->judul;
        $buku->kategori_id = $request->kategori;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahunterbit = $request->tahunterbit;
        $buku->stok = $request->stok;
        $buku->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/foto_buku');
            $buku->foto = str_replace('public/', '', $fotoPath);
        }

        
        $buku->save();

        return redirect()->route('buku.index', $buku->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        buku::where('id', $id)->delete();
        return redirect(route('buku.index'))->with(['Success' => 'Buku berhasil dihapus!']);
    }

    public function ulasanstore(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
        ]);

        $buku = Buku::find($id);

        // Check if $buku is a valid object
        if (!$buku) {
            return redirect()->route('buku.show')->with('error', 'Buku not found.');
        }

        Ulasan::create([
            'users_id' => Auth::id(),
            'buku_id' => $buku->id,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        return redirect()->route('buku.show')->with('success', 'Ulasan berhasil disimpan.');
    }
}
