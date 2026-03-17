<?php

namespace App\Livewire\Admin\Cms;

use Livewire\Component;
use App\Models\Galeri;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class GaleriManager extends Component
{
    use WithFileUploads;

    public $id_galeri, $kategori, $deskripsi, $gambar, $old_gambar;
    public $isModalOpen = false;

    // Tambahkan variabel ini untuk menampung data
    public function render()
    {
        // Pastikan variabel yang dikirim bernama 'galeries' 
        // sesuai dengan yang dipanggil di file blade
        return view('livewire.admin.cms.galeri-manager', [
            'galeries' => Galeri::latest()->get()
        ]);
    }

    public function openModal()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->id_galeri = null;
        $this->kategori = '';
        $this->deskripsi = '';
        $this->gambar = null;
        $this->old_gambar = null;
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate([
            'kategori'  => 'required|string',
            'deskripsi' => 'required|string',
            'gambar'    => $this->id_galeri ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'user_id'   => auth()->id(),
            'kategori'  => $this->kategori,
            'deskripsi' => $this->deskripsi,
        ];

        if ($this->gambar) {
            if ($this->old_gambar) {
                Storage::disk('public')->delete($this->old_gambar);
            }
            $data['gambar'] = $this->gambar->store('cms/galeri', 'public');
        }

        // Pastikan id_galeri benar
        Galeri::updateOrCreate(['id_galeri' => $this->id_galeri], $data);

        session()->flash('message_galeri', 'Foto galeri berhasil disimpan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        $this->id_galeri  = $id;
        $this->kategori   = $galeri->kategori;
        $this->deskripsi  = $galeri->deskripsi;
        $this->old_gambar = $galeri->gambar;
        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->gambar) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        $galeri->delete();
        session()->flash('message_galeri', 'Foto galeri berhasil dihapus!');
    }
}