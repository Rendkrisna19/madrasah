<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = '';
    public $password = '';

    public function authenticate()
    {
        // 1. Validasi Input
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba Login
        if (Auth::attempt($credentials)) {
            session()->regenerate();

            // 3. Cek Role dan Redirect ke route masing-masing
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role === 'guru') {
                return redirect()->intended(route('guru.dashboard'));
            } elseif ($user->role === 'wali_santri') {
                return redirect()->intended(route('wali-santri.dashboard'));
            }
            
            // Fallback jika role tidak terdaftar
            return redirect('/'); 
        }

        // 4. Jika Gagal Login
        $this->addError('email', 'Email atau password yang Anda masukkan salah.');
    }

    public function render()
    {
        // Ubah bagian ini:
        return view('livewire.auth.login')->layout('layouts.auth-layout');
    }
}