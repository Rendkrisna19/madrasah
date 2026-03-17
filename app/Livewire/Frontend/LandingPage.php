<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agenda;
use App\Models\Home;
use App\Models\Profil;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kontak;
use App\Models\Pendaftaran; // Pastikan Model Pendaftaran sudah dibuat
use Carbon\Carbon;

class LandingPage extends Component
{
    // Properti untuk Modal & Form PPDB
    public $isModalPPDB = false;
    public $nama_lengkap, $jk, $tempat_lahir, $tanggal_lahir, $asal_sekolah, $nama_ayah, $no_hp_orang_tua, $alamat_lengkap;

    #[Layout('layouts.frontend')] 
    public function render()
    {
        return view('livewire.frontend.landing-page', [
            'home'      => Home::first(),
            'profil'    => Profil::first(),
            'kontak'    => Kontak::first(),
            'agendas'   => Agenda::whereDate('tanggal', '>=', Carbon::today())
                            ->orderBy('tanggal', 'asc')
                            ->take(3)
                            ->get(),
            'beritas'   => Berita::latest()->take(3)->get(),
            'galeries'  => Galeri::latest()->take(8)->get(),
        ]);
    }

    // Fungsi Membuka Modal
    public function openPPDB()
    {
        $this->resetValidation();
        $this->isModalPPDB = true;
    }

    // Fungsi Menutup Modal
    public function closePPDB()
    {
        $this->isModalPPDB = false;
        $this->resetForm();
    }

    // Reset Form Input
    public function resetForm()
    {
        $this->reset([
            'nama_lengkap', 'jk', 'tempat_lahir', 'tanggal_lahir', 
            'asal_sekolah', 'nama_ayah', 'no_hp_orang_tua', 'alamat_lengkap'
        ]);
    }

    // Proses Simpan Pendaftaran
    public function submitPendaftaran()
    {
        $this->validate([
            'nama_lengkap'    => 'required|string|max:255',
            'jk'              => 'required|in:L,P',
            'tempat_lahir'    => 'required|string',
            'tanggal_lahir'   => 'required|date',
            'asal_sekolah'    => 'required|string',
            'nama_ayah'       => 'required|string',
            'no_hp_orang_tua' => 'required|numeric',
            'alamat_lengkap'  => 'required|string',
        ]);

        // Generate Nomor Pendaftaran Otomatis (PPDB-2026-001)
        $count = Pendaftaran::whereYear('created_at', date('Y'))->count() + 1;
        $noPendaftaran = 'PPDB-' . date('Y') . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        Pendaftaran::create([
            'no_pendaftaran'  => $noPendaftaran,
            'nama_lengkap'    => $this->nama_lengkap,
            'jk'              => $this->jk,
            'tempat_lahir'    => $this->tempat_lahir,
            'tanggal_lahir'   => $this->tanggal_lahir,
            'asal_sekolah'    => $this->asal_sekolah,
            'nama_ayah'       => $this->nama_ayah,
            'no_hp_orang_tua' => $this->no_hp_orang_tua,
            'alamat_lengkap'  => $this->alamat_lengkap,
            'status'          => 'Pending', // Status default
        ]);

        // Kirim notifikasi sukses
        session()->flash('success_ppdb', 'Pendaftaran Berhasil! Simpan No. Pendaftaran Anda: ' . $noPendaftaran);
        
        $this->closePPDB();
    }
}