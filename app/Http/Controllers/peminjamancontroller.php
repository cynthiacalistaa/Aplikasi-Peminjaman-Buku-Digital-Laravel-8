<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\buku;
use App\peminjaman;
use App\ulasan;
use Carbon\Carbon;


class peminjamancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjaman = Peminjaman::with('users')->get();
        $count = peminjaman::count();
            
        $this->updateStatus();
        return view('peminjaman.index', compact('peminjaman', 'count'));
    }

    protected function updateStatus()
    {
        $now = Carbon::now();

        // Get all records with expiration date in the past
        $peminjamans = Peminjaman::where('tanggalpengembalian', '<', $now)->get();

        foreach ($peminjamans as $peminjaman) {
            // Update the status
            $peminjaman->status = 1; // Assuming 1 means the status for returned books
            $peminjaman->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $peminjaman =  peminjaman::all();
        $book = buku::findOrFail($id);
        return view('peminjaman.create', compact('book', 'peminjaman'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $book = Buku::findOrFail($id);
        if ($book) {
            $book->decrement('stok');
        }
        
        $request->validate([
            'users_id' => 'required',
            'buku_id' => 'required|unique: tb_buku',
            'tanggalpeminjaman' => 'required',
            'tanggalpengembalian' => 'required',
            'status' => 'required'
        ]);

        $tanggalPeminjaman = Carbon::now();
        $tanggalPengembalian = $tanggalPeminjaman->copy()->addDays(7);

        peminjaman::create([
            'users_id' => $request->input('users_id'),
            'buku_id' => $id,
            'tanggalpeminjaman' => $tanggalPeminjaman,
            'tanggalpengembalian' => $tanggalPengembalian,
            'status' => 0,
        ]);

        return redirect()->route('pinjam.index')->with('success', 'Buku berhasil dipinjam!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $peminjaman = Peminjaman::with('users')->get();
        return view('admin.peminjaman', compact('peminjaman'));
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

    public function pengembalian($id)
    {
        $peminjaman = Peminjaman::find($id);
    
        if ($peminjaman) {
            $peminjaman->status = 1;
            $buku = $peminjaman->buku;
    
            if ($buku) {
                $buku->increment('stok');
            }
            $peminjaman->save();
    
            //return view('peminjaman.index')->with('success', 'Buku berhasil dikembalikan.');
            return redirect()->route('pinjam.index')->with('success', 'Buku berhasil dikembalikan.');
        } else {
            // Handle the case where $peminjaman is not found
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan.');
        }
    }

     

}
