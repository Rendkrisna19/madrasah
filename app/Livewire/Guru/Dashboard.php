<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        
        // Cek apakah user ini terhubung ke data Guru
        $guruId = $user->guru_id;

        // Ambil Jadwal Mengajar Guru ini
        $jadwals = Jadwal::with('kelas')
            ->where('guru_id', $guruId)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        // Ambil Kelas yang wali kelasnya adalah guru ini
        $kelasWali = Kelas::where('guru_id', $guruId)->first();
        
        // Hitung total santri yang diajar (di kelas walinya)
        $totalSantriWali = $kelasWali ? Santri::where('kelas_id', $kelasWali->id_kelas)->count() : 0;

        return view('livewire.guru.dashboard', [
            'user' => $user,
            'jadwals' => $jadwals,
            'kelasWali' => $kelasWali,
            'totalSantriWali' => $totalSantriWali,
            'hariIni' => now()->isoFormat('dddd'),
        ])->layout('layouts.guru'); // Tetap pakai layout admin biar konsisten
    }
}