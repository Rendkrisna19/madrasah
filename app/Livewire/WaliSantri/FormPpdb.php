<?php

namespace App\Livewire\WaliSantri;

use App\Models\Pendaftaran;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.walisantri')]
class FormPpdb extends Component
{
    public $id_pendaftaran, $nama_lengkap, $jk, $tempat_lahir, $tanggal_lahir, $asal_sekolah, $nama_ayah, $no_hp_orang_tua, $alamat_lengkap;
    public $isModalOpen = false;

    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'jk' => 'required|in:L,P',
        'tempat_lahir' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'asal_sekolah' => 'required|string',
        'nama_ayah' => 'required|string',
        'no_hp_orang_tua' => 'required|string',
        'alamat_lengkap' => 'required|string',
    ];

    public function openModal() {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function closeModal() {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields() {
        $this->id_pendaftaran = null;
        $this->nama_lengkap = '';
        $this->jk = '';
        $this->tempat_lahir = '';
        $this->tanggal_lahir = '';
        $this->asal_sekolah = '';
        $this->nama_ayah = '';
        $this->no_hp_orang_tua = '';
        $this->alamat_lengkap = '';
    }

    public function edit($id) {
        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->findOrFail($id);
        
        // Mencegah edit jika status sudah diproses (Bukan Pending)
        if($pendaftaran->status !== 'Pending') {
            session()->flash('error', 'Data yang sudah diproses tidak dapat diubah.');
            return;
        }

        $this->id_pendaftaran = $id;
        $this->nama_lengkap = $pendaftaran->nama_lengkap;
        $this->jk = $pendaftaran->jk;
        $this->tempat_lahir = $pendaftaran->tempat_lahir;
        $this->tanggal_lahir = $pendaftaran->tanggal_lahir;
        $this->asal_sekolah = $pendaftaran->asal_sekolah;
        $this->nama_ayah = $pendaftaran->nama_ayah;
        $this->no_hp_orang_tua = $pendaftaran->no_hp_orang_tua;
        $this->alamat_lengkap = $pendaftaran->alamat_lengkap;
        
        $this->isModalOpen = true;
    }

    public function delete($id) {
        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->findOrFail($id);
        if($pendaftaran->status === 'Pending') {
            $pendaftaran->delete();
            session()->flash('message', 'Data pendaftaran berhasil dihapus.');
        }
    }

    public function store() {
        $this->validate();

        $data = [
            'user_id' => Auth::id(),
            'nama_lengkap' => $this->nama_lengkap,
            'jk' => $this->jk,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'asal_sekolah' => $this->asal_sekolah,
            'nama_ayah' => $this->nama_ayah,
            'no_hp_orang_tua' => $this->no_hp_orang_tua,
            'alamat_lengkap' => $this->alamat_lengkap,
        ];

        if ($this->id_pendaftaran) {
            Pendaftaran::where('id_pendaftaran', $this->id_pendaftaran)->update($data);
            session()->flash('message', 'Data berhasil diperbarui.');
        } else {
            // Generate Nomor Pendaftaran Otomatis
            $data['no_pendaftaran'] = 'PPDB-' . date('Y') . '-' . rand(1000, 9999);
            Pendaftaran::create($data);
            session()->flash('message', 'Pendaftaran berhasil dikirim. Menunggu verifikasi.');
        }

        $this->closeModal();
    }

    public function render() {
        return view('livewire.wali-santri.form-ppdb', [
            // Hanya mengambil data anak dari wali santri yang login
            'pendaftarans' => Pendaftaran::where('user_id', Auth::id())->latest()->get()
        ]);
    }
}