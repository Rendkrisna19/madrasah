<?php

namespace App\Livewire\WaliSantri;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.walisantri')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.wali-santri.dashboard', [
            'user' => Auth::user()
        ]);
    }
}