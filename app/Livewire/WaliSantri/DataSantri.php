<?php

namespace App\Livewire\WaliSantri;

use App\Models\Santri;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.walisantri')]
class DataSantri extends Component
{
    public function render()
    {
        // Mengambil data santri yang terhubung dengan ID Wali Santri yang sedang login
        // Pastikan relasi 'kelas' ikut dipanggil agar nama kelasnya muncul
        $santris = Santri::with('kelas')
            ->where('user_id', Auth::id())
            ->get();

        return view('livewire.wali-santri.data-santri', [
            'santris' => $santris
        ]);
    }
}