<?php

namespace App\Livewire\Admin\Akademik;

use App\Models\Guru;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class GuruManager extends Component
{
    use WithPagination;

    public $search = '';
    public $id_guru, $nip, $nama_guru, $mapel, $no_hp;
    public $isModalOpen = false;

    protected $rules = [
        'nip' => 'required|unique:gurus,nip',
        'nama_guru' => 'required',
        'mapel' => 'required',
        'no_hp' => 'required',
    ];

    public function openModal() {
        $this->resetInput();
        $this->isModalOpen = true;
    }

    public function closeModal() {
        $this->isModalOpen = false;
    }

    private function resetInput() {
        $this->nip = ''; 
        $this->nama_guru = ''; 
        $this->mapel = ''; 
        $this->no_hp = ''; 
        $this->id_guru = null;
    }

    public function store() {
        $rules = $this->rules;
        if($this->id_guru) $rules['nip'] = 'required|unique:gurus,nip,' . $this->id_guru . ',id_guru';
        
        $this->validate($rules);

        Guru::updateOrCreate(['id_guru' => $this->id_guru], [
            'nip' => $this->nip,
            'nama_guru' => $this->nama_guru,
            'mapel' => $this->mapel,
            'no_hp' => $this->no_hp,
        ]);

        session()->flash('message', $this->id_guru ? 'Data Guru berhasil diperbarui.' : 'Data Guru berhasil ditambahkan.');
        $this->closeModal();
        $this->resetInput();
    }

    // Penghapusan normal dengan proteksi Foreign Key
    public function delete($id) {
        try {
            Guru::findOrFail($id)->delete();
            session()->flash('message', 'Data Guru berhasil dihapus.');
        } catch (QueryException $e) {
            // Cek apakah error karena relasi data (Foreign Key Constraint 1451)
            if ($e->getCode() == '23000') {
                session()->flash('error', 'Gagal menghapus! Guru tidak bisa dihapus karena masih terhubung dengan data Jadwal. Gunakan tombol "Paksa Hapus" jika ingin menghapus semua.');
            } else {
                session()->flash('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            }
        }
    }

    // Penghapusan paksa beserta relasi jadwalnya
    public function forceDelete($id) {
        try {
            // Hapus jadwal guru ini terlebih dahulu
            DB::table('jadwals')->where('guru_id', $id)->delete();
            
            // Setelah jadwal bersih, hapus gurunya
            Guru::findOrFail($id)->delete();
            
            session()->flash('message', 'Data Guru beserta seluruh jadwalnya berhasil dihapus paksa.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal hapus paksa: ' . $e->getMessage());
        }
    }

    public function edit($id) {
        $guru = Guru::findOrFail($id);
        $this->id_guru = $id;
        $this->nip = $guru->nip;
        $this->nama_guru = $guru->nama_guru;
        $this->mapel = $guru->mapel;
        $this->no_hp = $guru->no_hp;
        $this->isModalOpen = true;
    }

    public function render() {
        return view('livewire.admin.akademik.guru-manager', [
            'gurus' => Guru::where('nama_guru', 'like', '%'.$this->search.'%')->latest()->paginate(10)
        ]);
    }
}