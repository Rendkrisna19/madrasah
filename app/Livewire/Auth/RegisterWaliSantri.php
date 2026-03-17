<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str; // Tambahkan ini untuk buat random string

#[Layout('layouts.app')]
class RegisterWaliSantri extends Component
{
    // Ubah $name jadi $nama sesuai nama kolom di database
    public $nama; 
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function register()
    {
        $this->validate();

        try {
            // Karena tabel kamu butuh 'username', kita generate otomatis
            // Misalnya: walisantri_12345
            $autoUsername = 'wali_' . Str::random(5) . '_' . time();

            $user = User::create([
                'nama' => $this->nama,
                'username' => $autoUsername, // Kirim username
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => 'wali_santri', 
            ]);

            Auth::login($user);

            return redirect()->route('wali-santri.dashboard');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.auth.register-wali-santri');
    }
}