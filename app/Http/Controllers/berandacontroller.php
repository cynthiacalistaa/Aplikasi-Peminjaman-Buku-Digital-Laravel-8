<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\kategori;
use App\buku;

class berandacontroller extends Controller
{
    public function listbuku()
    {
        $buku = buku::with('ulasan')->get();
        $kategori = kategori::all();
        $users_id = auth()->id();
        return view('dashboard', compact('kategori', 'buku', 'users_id'));
    }


}
