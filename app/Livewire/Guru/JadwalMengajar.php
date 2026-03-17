<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class JadwalMengajar extends Component
{
    // Memaksa Livewire menggunakan layout khusus guru
    #[Layout('layouts.guru')] 
    public function render()
    {
        $user = Auth::user();
        
        // Ambil guru_id dari user (mengikuti logic dashboard kamu yang berhasil)
        $guruId = $user->guru_id; 

        // Query data jadwal
        $jadwalKu = Jadwal::with(['kelas'])
            ->where('guru_id', $guruId) 
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai', 'asc')
            ->get();

        return view('livewire.guru.jadwal-mengajar', [
            'jadwalKu' => $jadwalKu
        ]);
    }
}