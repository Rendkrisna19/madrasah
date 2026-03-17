<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $primaryKey = 'id_profil';
    protected $fillable = ['user_id', 'sejarah', 'visi_misi', 'struktur_organisasi'];

    public function user() { return $this->belongsTo(User::class); }
}
