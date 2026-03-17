<?php

namespace App\Livewire\Admin\Cms;

use Livewire\Component;
use App\Models\Kontak;

class KontakManager extends Component
{
    public $id_kontak, $alamat, $no_hp, $email, $lokasi_maps;

    public function mount()
    {
        $kontak = Kontak::first();
        if ($kontak) {
            $this->id_kontak  = $kontak->id_kontak;
            $this->alamat     = $kontak->alamat;
            $this->no_hp      = $kontak->no_hp;
            $this->email      = $kontak->email;
            $this->lokasi_maps = $kontak->lokasi_maps;
        }
    }

    public function store()
    {
        $this->validate([
            'alamat' => 'required|string',
            'no_hp'  => 'required|string',
            'email'  => 'required|email',
        ]);

        Kontak::updateOrCreate(
            ['id_kontak' => $this->id_kontak],
            [
                'user_id'     => auth()->id(),
                'alamat'      => $this->alamat,
                'no_hp'       => $this->no_hp,
                'email'       => $this->email,
                'lokasi_maps' => $this->lokasi_maps,
            ]
        );

        session()->flash('message_kontak', 'Informasi kontak berhasil diperbarui!');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.cms.kontak-manager');
    }
}