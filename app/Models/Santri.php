<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Absensi;

class Santri extends Model
{
    protected $table = 'santris'; // Sesuaikan nama tabelmu
    protected $primaryKey = 'id_santri'; // Karena kamu pakai id_santri
    
    protected $guarded = [];

    public function kelas()
    {
        /**
         * Parameter 2: nama kolom foreign key di tabel santris (kelas_id)
         * Parameter 3: nama kolom primary key di tabel kelas (id_kelas)
         */
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }

    public function rekapAbsen($bulan, $tahun)
{
    return [
        'H' => $this->hasMany(Absensi::class, 'santri_id', 'id_santri')->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status', 'H')->count(),
        'S' => $this->hasMany(Absensi::class, 'santri_id', 'id_santri')->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status', 'S')->count(),
        'I' => $this->hasMany(Absensi::class, 'santri_id', 'id_santri')->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status', 'I')->count(),
        'A' => $this->hasMany(Absensi::class, 'santri_id', 'id_santri')->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status', 'A')->count(),
    ];
}

public function wali()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
