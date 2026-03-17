<?php

namespace App\Livewire\Admin\Akademik;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Guru;
use Livewire\Component;

class JadwalManager extends Component
{
    public $id_jadwal, $kelas_id, $guru_id, $nama_mapel, $hari, $jam_mulai, $jam_selesai;
    public $isModalOpen = false;
    public $filterKelas = '';

    public function render()
    {
        $query = Jadwal::with(['kelas', 'guru']);
        if($this->filterKelas) $query->where('kelas_id', $this->filterKelas);

        return view('livewire.admin.akademik.jadwal-manager', [
            'jadwals' => $query->orderBy('hari')->orderBy('jam_mulai')->get(),
            'listKelas' => Kelas::all(),
            'listGuru' => Guru::all(),
            'listHari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad']
        ]);
    }

    public function openModal() { $this->isModalOpen = true; }
    public function closeModal() { $this->isModalOpen = false; $this->resetExcept('filterKelas'); }

    public function store()
    {
        $this->validate([
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'nama_mapel' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        Jadwal::updateOrCreate(['id_jadwal' => $this->id_jadwal], [
            'kelas_id' => $this->kelas_id,
            'guru_id' => $this->guru_id,
            'nama_mapel' => $this->nama_mapel,
            'hari' => $this->hari,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
        ]);

        $this->closeModal();
    }

    public function delete($id) { Jadwal::find($id)->delete(); }
}