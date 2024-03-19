<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $fillable = ['namakategori', 'foto'];

    protected $table = 'tb_kategoribuku';

    public function buku(): HasMany
    {
        return $this->hasMany('App\tb_buku');
    }
}
