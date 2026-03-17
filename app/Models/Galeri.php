<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $primaryKey = 'id_galeri';
    protected $fillable = ['user_id', 'kategori', 'gambar', 'deskripsi'];

    public function user() { return $this->belongsTo(User::class); }
}
