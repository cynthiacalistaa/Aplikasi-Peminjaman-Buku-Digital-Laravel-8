<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ulasan extends Model
{
    protected $table = 'tb_ulasanbuku';

    protected $fillable = ['users_id', 'buku_id', 'rating', 'ulasan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'id');
    }
}
