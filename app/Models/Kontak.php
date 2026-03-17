<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $primaryKey = 'id_kontak';
    protected $fillable = ['user_id', 'alamat', 'no_hp', 'email', 'lokasi_maps'];

    public function user() { return $this->belongsTo(User::class); }
}
