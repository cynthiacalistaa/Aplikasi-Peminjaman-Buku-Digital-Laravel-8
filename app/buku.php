<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    protected $fillable = [
        'foto',
        'judul',
        'kategori_id',
        'penulis',
        'penerbit',
        'tahunterbit',
        'stok',
        'deskripsi'
    ];

    protected $table = 'tb_buku';

    public function koleksipribadi()
    {
        return $this->hasMany(koleksi::class);
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'buku_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }
}
