<?php

namespace App\Livewire\Admin\Ppdb;

use App\Models\Pendaftaran;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class PpdbManager extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $selectedPendaftaran; // Untuk simpan data detail yang mau dilihat
    public $isModalDetailOpen = false;

    #[Layout('layouts.admin-layout')] 
    public function render()
    {
        $query = Pendaftaran::query()
            ->where(function($q) {
                $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                  ->orWhere('no_pendaftaran', 'like', '%' . $this->search . '%');
            });

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        return view('livewire.admin.ppdb.ppdb-manager', [
            'pendaftarans' => $query->latest()->paginate(10)
        ]);
    }

    public function updateStatus($id, $status)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => $status]);

        session()->flash('message_ppdb', "Status pendaftaran {$pendaftaran->no_pendaftaran} diubah menjadi {$status}.");
    }

    public function showDetail($id)
    {
        $this->selectedPendaftaran = Pendaftaran::findOrFail($id);
        $this->isModalDetailOpen = true;
    }

    public function closeModal()
    {
        $this->isModalDetailOpen = false;
    }

    public function delete($id)
    {
        Pendaftaran::destroy($id);
        session()->flash('message_ppdb', 'Data pendaftaran berhasil dihapus.');
    }
}