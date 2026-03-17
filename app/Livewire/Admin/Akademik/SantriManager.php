<?php
namespace App\Livewire\Admin\Akademik;

use App\Models\Santri;
use App\Models\Kelas;
use Livewire\Component;
use Livewire\WithPagination;

class SantriManager extends Component
{
    use WithPagination;

    public $search = '';
    public $id_santri, $nis, $nama_santri, $jk, $kelas_id;
    public $isModalOpen = false;

    public function render() {
        return view('livewire.admin.akademik.santri-manager', [
            'santris' => Santri::with('kelas')
                ->where('nama_santri', 'like', '%'.$this->search.'%')
                ->latest()
                ->paginate(10),
            'listKelas' => Kelas::all()
        ]);
    }

    public function openModal() { 
        $this->isModalOpen = true; 
    }

    public function closeModal() { 
        $this->isModalOpen = false; 
        $this->resetInputFields();
        $this->resetErrorBag();
    }

    private function resetInputFields() {
        $this->id_santri = null;
        $this->nis = '';
        $this->nama_santri = '';
        $this->jk = '';
        $this->kelas_id = '';
    }

    // --- FUNGSI EDIT ---
    public function edit($id) {
        $santri = Santri::findOrFail($id);
        $this->id_santri = $id;
        $this->nis = $santri->nis;
        $this->nama_santri = $santri->nama_santri;
        $this->jk = $santri->jk;
        $this->kelas_id = $santri->kelas_id;

        $this->openModal();
    }

    // --- FUNGSI DELETE ---
    public function delete($id) {
        Santri::find($id)->delete();
        session()->flash('message', 'Data Santri Berhasil Dihapus.');
    }

    public function store() {
        $this->validate([
            'nis' => 'required',
            'nama_santri' => 'required',
            'jk' => 'required',
            'kelas_id' => 'required',
        ]);

        Santri::updateOrCreate(['id_santri' => $this->id_santri], [
            'nis' => $this->nis,
            'nama_santri' => $this->nama_santri,
            'jk' => $this->jk,
            'kelas_id' => $this->kelas_id,
        ]);

        session()->flash('message', $this->id_santri ? 'Data Santri Berhasil Diupdate.' : 'Data Santri Berhasil Disimpan.');

        $this->closeModal();
    }
}