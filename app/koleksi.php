<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class koleksi extends Model
{
    protected $fillable = [
        'users_id',
        'buku_id'
    ];

    protected $table = 'tb_koleksipribadi';

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id'); 
    }
}
