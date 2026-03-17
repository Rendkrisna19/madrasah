<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $primaryKey = 'id_kelas';
    protected $guarded = [];
    public function wali()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
    public function santris()
    {
        return $this->hasMany(Santri::class, 'kelas_id');
    }
   public function santri()
    {
        return $this->hasMany(Santri::class);
    }

    // Relasi ke Jadwal (Satu kelas punya banyak jadwal)
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
