<?php

namespace App\Livewire\Admin\Cms;

use Livewire\Component;
use App\Models\Profil;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProfilManager extends Component
{
    use WithFileUploads;

    public $id_profil, $sejarah, $visi_misi, $struktur_organisasi, $old_struktur;

    public function mount()
    {
        $profil = Profil::first();
        if ($profil) {
            $this->id_profil = $profil->id_profil;
            $this->sejarah = $profil->sejarah;
            $this->visi_misi = $profil->visi_misi;
            $this->old_struktur = $profil->struktur_organisasi;
        }
    }

    public function store()
    {
        $this->validate([
            'sejarah' => 'required',
            'visi_misi' => 'required',
            'struktur_organisasi' => $this->id_profil ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'sejarah' => $this->sejarah,
            'visi_misi' => $this->visi_misi,
        ];

        if ($this->struktur_organisasi) {
            if ($this->old_struktur) { Storage::disk('public')->delete($this->old_struktur); }
            $data['struktur_organisasi'] = $this->struktur_organisasi->store('cms/profil', 'public');
        }

        Profil::updateOrCreate(['id_profil' => $this->id_profil], $data);

        session()->flash('message_profil', 'Konten Profil Berhasil Disimpan!');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.cms.profil-manager');
    }
}