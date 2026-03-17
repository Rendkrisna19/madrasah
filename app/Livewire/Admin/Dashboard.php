<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Santri;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Pendaftaran;

class Dashboard extends Component
{
    public function render()
    {
        // Data Statistik Real
        $totalGuru = Guru::count();
        $totalSantri = Santri::count();
        $totalKelas = Kelas::count();
        
        // Menghitung pendaftar dengan status 'Pending'
        $pendaftarBaru = Pendaftaran::where('status', 'Pending')->count();

        // Mengambil 5 Pendaftar PPDB terbaru untuk ditampilkan di list
        $latestPendaftaran = Pendaftaran::latest()->take(5)->get();

        return view('livewire.admin.dashboard', [
            'totalSantri' => $totalSantri,
            'totalGuru' => $totalGuru,
            'totalKelas' => $totalKelas,
            'pendaftarBaru' => $pendaftarBaru,
            'latestPendaftaran' => $latestPendaftaran,
        ])->layout('layouts.admin-layout'); 
    }
}