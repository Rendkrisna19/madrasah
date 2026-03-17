<?php

namespace App\Livewire\Admin\Akademik;

use App\Models\Kelas;
use App\Models\Guru;
use Livewire\Component;
use Livewire\WithPagination;

class KelasManager extends Component
{
    use WithPagination;

    public $search = '';
    public $id_kelas, $nama_kelas, $guru_id;
    public $isModalOpen = false;

    public function render()
    {
        return view('livewire.admin.akademik.kelas-manager', [
            'listKelas' => Kelas::with('wali')
                ->where('nama_kelas', 'like', '%' . $this->search . '%')
                ->latest()->paginate(10),
            'listGuru' => Guru::all()
        ]);
    }

    public function openModal() { $this->isModalOpen = true; }
    public function closeModal() { $this->isModalOpen = false; $this->reset(['id_kelas', 'nama_kelas', 'guru_id']); }

    public function store()
    {
        $this->validate([
            'nama_kelas' => 'required|string|max:50',
            'guru_id' => 'required|exists:gurus,id_guru',
        ]);

        Kelas::updateOrCreate(['id_kelas' => $this->id_kelas], [
            'nama_kelas' => $this->nama_kelas,
            'guru_id' => $this->guru_id,
        ]);

        session()->flash('message', $this->id_kelas ? 'Kelas diperbarui.' : 'Kelas berhasil dibuat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $this->id_kelas = $id;
        $this->nama_kelas = $kelas->nama_kelas;
        $this->guru_id = $kelas->guru_id;
        $this->openModal();
    }

    public function delete($id)
    {
        Kelas::find($id)->delete();
        session()->flash('message', 'Kelas berhasil dihapus.');
    }
}