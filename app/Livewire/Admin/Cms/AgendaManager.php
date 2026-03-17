<?php

namespace App\Livewire\Admin\Cms;

use Livewire\Component;
use App\Models\Agenda;
use Illuminate\Support\Facades\Auth;

class AgendaManager extends Component
{
    // Hapus $agendas dari public property. Sisakan data form saja.
    public $agenda_id, $nama_agenda, $tanggal, $deskripsi;
    
    // State Modal
    public $isModalOpen = false;
    public $isDeleteModalOpen = false;

    // Menampilkan Data
    public function render()
    {
        // Passing data langsung ke view agar tidak error saat serialisasi Livewire
        $agendas = Agenda::latest()->get();
        return view('livewire.admin.cms.agenda-manager', compact('agendas'));
    }

    // --- FUNGSI MODAL ---
    public function openModal()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetFields();
        $this->resetValidation(); // Hapus pesan error jika modal ditutup
    }

    public function resetFields()
    {
        $this->agenda_id = null;
        $this->nama_agenda = '';
        $this->tanggal = '';
        $this->deskripsi = '';
    }

    // --- PROSES CRUD ---
    public function store()
    {
        $this->validate([
            'nama_agenda' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        Agenda::updateOrCreate(
            ['id_agenda' => $this->agenda_id], // Patokan update berdasarkan id_agenda
            [
                'user_id' => Auth::id(),
                'nama_agenda' => $this->nama_agenda,
                'tanggal' => $this->tanggal,
                'deskripsi' => $this->deskripsi,
            ]
        );

        session()->flash('message', $this->agenda_id ? 'Agenda berhasil diperbarui!' : 'Agenda berhasil ditambahkan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        // Gunakan where untuk memastikan mencari ke kolom id_agenda
        $agenda = Agenda::where('id_agenda', $id)->firstOrFail();
        
        $this->agenda_id = $agenda->id_agenda;
        $this->nama_agenda = $agenda->nama_agenda;
        $this->tanggal = $agenda->tanggal;
        $this->deskripsi = $agenda->deskripsi;
        
        $this->isModalOpen = true;
    }

    public function confirmDelete($id)
    {
        $this->agenda_id = $id;
        $this->isDeleteModalOpen = true;
    }

    public function delete()
    {
        // Gunakan where agar aman jika model belum di-set primary key-nya
        Agenda::where('id_agenda', $this->agenda_id)->delete();
        
        session()->flash('message', 'Agenda berhasil dihapus!');
        $this->isDeleteModalOpen = false;
        $this->resetFields();
    }
}