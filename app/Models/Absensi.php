<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensis';
    protected $primaryKey = 'id_absensi'; // Sesuai migration tadi

    // Mengizinkan semua kolom diisi
    protected $guarded = [];

    // Relasi ke Santri (untuk menampilkan nama di rekap)
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id', 'id_santri');
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }
}