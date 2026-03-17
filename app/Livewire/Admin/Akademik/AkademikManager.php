<?php
namespace App\Livewire\Admin\Akademik;

use Livewire\Component;
use Livewire\Attributes\Layout;

class AkademikManager extends Component
{
    #[Layout('layouts.admin-layout')] // Sesuaikan nama layout admin kamu
    public function render()
    {
        return view('livewire.admin.akademik.akademik-manager');
    }
}