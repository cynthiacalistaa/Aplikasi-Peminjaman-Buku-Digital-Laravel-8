<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
use App\peminjaman;

class laporancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cetakLaporan(Request $request)
    {
        $tanggalPilih = $request->input('tanggal_pilih');

        $peminjaman = Peminjaman::whereDate('tanggalpeminjaman', $tanggalPilih)->get();

        $pdf = PDF::loadView('admin.cetak-peminjaman', ['peminjaman' => $peminjaman, 'tanggalPilih' => $tanggalPilih]);

        return $pdf->download('laporan_peminjaman.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pengguna()
    {
        $user = user::all();
        return view('peminjaman.user', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cetakPengguna()
    {
        $users = User::all(); // Sesuaikan dengan model dan query data pengguna Anda

        $pdf = PDF::loadView('admin.cetak-pengguna', ['user' => $users]);

        return $pdf->download('cetak_pengguna.pdf');
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
        //
    }
}
