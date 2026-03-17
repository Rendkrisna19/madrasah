<?php

namespace App\Livewire\Admin\Cms;

use Livewire\Component;
use App\Models\Berita;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaManager extends Component
{
    use WithFileUploads;

    // Properti Data Form
    public $berita_id, $judul, $konten, $image, $old_image;
    
    // Properti List Data & UI
    public $beritas;
    public $isModalOpen = false;

    /**
     * Render komponen ke view
     */
    public function render()
    {
        $this->beritas = Berita::latest()->get();
        return view('livewire.admin.cms.berita-manager');
    }

    /**
     * Membuka modal untuk Tambah Data
     */
    public function openModal()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    /**
     * Menutup modal dan membersihkan form
     */
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetFields();
    }

    /**
     * Reset semua field input
     */
    public function resetFields()
    {
        $this->berita_id = null;
        $this->judul = '';
        $this->konten = '';
        $this->image = null;
        $this->old_image = null;
        $this->resetValidation();
    }

    /**
     * Fungsi Simpan (Create & Update)
     */
    public function store()
    {
        // Validasi input
        $this->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'image' => $this->berita_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'user_id'      => auth()->id(),
            'judul_berita' => $this->judul,
            'isi_berita'   => $this->konten,
            'tanggal'      => now(),
            'deskripsi'    => Str::limit(strip_tags($this->konten), 150),
        ];

        // Penanganan Upload Gambar
        if ($this->image) {
            // Hapus gambar lama jika ada (saat update)
            if ($this->old_image) {
                Storage::disk('public')->delete($this->old_image);
            }
            // Simpan gambar baru ke folder 'berita' di disk public
            $data['gambar'] = $this->image->store('berita', 'public');
        }

        // Proses Simpan menggunakan id_berita sebagai primary key
        Berita::updateOrCreate(
            ['id_berita' => $this->berita_id], 
            $data
        );

        session()->flash('message', $this->berita_id ? 'Berita berhasil diperbarui!' : 'Berita berhasil ditambahkan!');
        
        $this->closeModal();
    }

    /**
     * Mengambil data untuk proses Edit
     * @param int $id sesuai dengan id_berita
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        
        $this->berita_id = $id;
        // Ambil data dari kolom asli di database (judul_berita & isi_berita)
        $this->judul     = $berita->judul_berita;
        $this->konten    = $berita->isi_berita;
        $this->old_image = $berita->gambar;
        
        $this->isModalOpen = true;
    }

    /**
     * Menghapus data berita dan file gambarnya
     * @param int $id sesuai dengan id_berita
     */
    public function delete($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Hapus file gambar dari storage
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        
        $berita->delete();
        
        session()->flash('message', 'Berita berhasil dihapus!');
    }
}