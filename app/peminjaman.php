<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $fillable = [
        'users_id',
        'buku_id',
        'tanggalpeminjaman',
        'tanggalpengembalian',
        'status'
    ];

    protected $table = 'tb_peminjaman';

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function buku()
    {
        return $this->belongsTo(buku::class, 'buku_id');
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'peminjaman_id', 'id');
    }
}
