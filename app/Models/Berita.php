<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    // Beritahu Laravel bahwa primary key-nya bukan 'id'
    protected $primaryKey = 'id_berita'; 

    // Jika id_berita bukan auto-increment (opsional, biasanya tetap true)
    public $incrementing = true;

    protected $guarded = [];
}