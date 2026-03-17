<?php

namespace App\Livewire\Admin\Pengguna;

use App\Models\User;
use App\Models\Guru; // Import Model Guru
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;

class PenggunaManager extends Component
{
    use WithPagination;

    public $id_user, $nama, $username, $email, $password, $role, $guru_id;
    public $search = '';
    public $isModalOpen = false;

    #[Layout('layouts.admin-layout')]
    public function render()
    {
        return view('livewire.admin.pengguna.pengguna-manager', [
            'users' => User::where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%')
                ->latest()->paginate(10),
            'listGuru' => Guru::all() // Ambil daftar guru untuk dropdown
        ]);
    }

    public function openModal()
    {
        $this->resetInput();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->id_user = null;
        $this->nama = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->role = 'wali_santri';
        $this->guru_id = null; // Reset guru_id
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $this->id_user,
            'email' => 'required|email|unique:users,email,' . $this->id_user,
            'role' => 'required|in:admin,guru,wali_santri',
            // guru_id wajib diisi hanya jika role-nya adalah 'guru'
            'guru_id' => 'required_if:role,guru',
        ];

        if (!$this->id_user) {
            $rules['password'] = 'required|min:6';
        }

        $this->validate($rules);

        $data = [
            'nama' => $this->nama,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
            'guru_id' => ($this->role === 'guru') ? $this->guru_id : null,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->id_user], $data);

        session()->flash('message_user', $this->id_user ? 'Pengguna diperbarui!' : 'Pengguna baru ditambahkan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->id_user = $id;
        $this->nama = $user->nama;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->guru_id = $user->guru_id;
        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        if ($id == auth()->id()) {
            session()->flash('error_user', 'Anda tidak bisa menghapus akun sendiri!');
            return;
        }
        User::destroy($id);
        session()->flash('message_user', 'Pengguna berhasil dihapus.');
    }
}