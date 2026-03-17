<?php

namespace App\Livewire\Admin\Akademik;

use App\Models\Guru;
use Livewire\Component;
use Livewire\WithPagination;

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
        $this->nip = ''; $this->nama_guru = ''; $this->mapel = ''; $this->no_hp = ''; $this->id_guru = null;
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

        session()->flash('message', $this->id_guru ? 'Guru diperbarui.' : 'Guru ditambahkan.');
        $this->closeModal();
        $this->resetInput();
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

    public function delete($id) {
        Guru::find($id)->delete();
        session()->flash('message', 'Guru dihapus.');
    }

    public function render() {
        return view('livewire.admin.akademik.guru-manager', [
            'gurus' => Guru::where('nama_guru', 'like', '%'.$this->search.'%')->latest()->paginate(10)
        ]);
    }
}