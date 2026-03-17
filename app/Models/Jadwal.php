<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    protected $primaryKey = 'id_jadwal'; // Sesuai screenshot kamu

    protected $fillable = [
        'id_jadwal',   // Tambahkan ini sesuai pesan error
        'kelas_id',
        'guru_id',
        'nama_mapel',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    // HANYA butuh relasi ke Kelas
    

    public function guru()
    {
        // Parameter 1: Model tujuannya (User atau Guru)
        // Parameter 2: Nama kolom foreign key di tabel jadwals
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    
}
