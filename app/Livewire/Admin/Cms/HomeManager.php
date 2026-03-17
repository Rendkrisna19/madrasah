<?php

namespace App\Livewire\Admin\Cms;

use Livewire\Component;
use App\Models\Home;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class HomeManager extends Component
{
    use WithFileUploads;

    public $id_home, $sambutan, $banner, $old_banner;

    public function mount()
    {
        $home = Home::first();
        if ($home) {
            $this->id_home = $home->id_home;
            $this->sambutan = $home->sambutan;
            $this->old_banner = $home->banner;
        }
    }

    public function store()
    {
        $this->validate([
            'sambutan' => 'required',
            'banner' => $this->id_home ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'sambutan' => $this->sambutan,
        ];

        if ($this->banner) {
            if ($this->old_banner) { Storage::disk('public')->delete($this->old_banner); }
            $data['banner'] = $this->banner->store('cms/home', 'public');
        }

        Home::updateOrCreate(['id_home' => $this->id_home], $data);

        session()->flash('message_home', 'Konten Beranda Berhasil Disimpan!');
        $this->mount(); // Refresh data
    }

    public function render()
    {
        return view('livewire.admin.cms.home-manager');
    }
}