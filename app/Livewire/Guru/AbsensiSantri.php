<?php

namespace App\Livewire\Guru;

use App\Models\Santri;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\Jadwal;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.guru')]
class AbsensiSantri extends Component
{
    public $kelas_id = '';
    public $tanggal;
    public $absensiData = [];
    public $listKelas = [];

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->loadKelas();
    }

    // Mengambil data kelas khusus untuk guru yang login
    public function loadKelas()
    {
        $guruId = Auth::user()->guru_id;
        $listKelasId = Jadwal::where('guru_id', $guruId)->distinct()->pluck('kelas_id');
        $this->listKelas = Kelas::whereIn('id_kelas', $listKelasId)->get();
    }

    // Hook: Otomatis jalan saat kelas_id berubah di dropdown/tombol
    public function updatedKelasId()
    {
        $this->loadSantri();
    }

    // Hook: Otomatis jalan saat tanggal diubah
    public function updatedTanggal()
    {
        $this->loadSantri();
    }

    public function loadSantri()
    {
        $this->absensiData = []; // Reset form

        if ($this->kelas_id) {
            $santris = Santri::where('kelas_id', $this->kelas_id)->orderBy('nama_santri', 'asc')->get();
            
            foreach ($santris as $s) {
                $existing = Absensi::where('santri_id', $s->id_santri)
                    ->where('tanggal', $this->tanggal)
                    ->first();

                // Set default ke 'H' (Hadir) jika belum ada data hari ini
                $this->absensiData[$s->id_santri] = $existing ? $existing->status : 'H';
            }
        }
    }

    public function saveAbsensi()
    {
        if (!$this->kelas_id) {
            session()->flash('error', 'Silakan pilih kelas terlebih dahulu.');
            return;
        }

        try {
            foreach ($this->absensiData as $santriId => $status) {
                Absensi::updateOrCreate(
                    ['santri_id' => $santriId, 'tanggal' => $this->tanggal],
                    [
                        'kelas_id' => $this->kelas_id,
                        'guru_id' => Auth::id(),
                        'status' => $status
                    ]
                );
            }
            session()->flash('message', 'Data absensi berhasil disimpan!');
            
            // Reload data santri setelah save untuk memastikan sinkron
            $this->loadSantri();
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan Server: ' . $e->getMessage());
        }
    }

    public function render()
    {
        // Kalkulasi Rekapitulasi secara Real-Time berdasarkan isi array
        $rekap = ['H' => 0, 'S' => 0, 'I' => 0, 'A' => 0];
        foreach ($this->absensiData as $status) {
            if (isset($rekap[$status])) {
                $rekap[$status]++;
            }
        }

        return view('livewire.guru.absensi-santri', [
            'santris' => $this->kelas_id ? Santri::where('kelas_id', $this->kelas_id)->orderBy('nama_santri', 'asc')->get() : [],
            'rekap' => $rekap
        ]);
    }
}