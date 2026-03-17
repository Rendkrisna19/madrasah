<?php
namespace App\Livewire\Admin\Cms;

use Livewire\Component;

class CmsManager extends Component
{
    public function render()
    {
        // Pastikan 'livewire.admin.cms.cms-manager' sesuai dengan nama file blade komponenmu
        return view('livewire.admin.cms.cms-manager')
            ->layout('layouts.admin-layout');
    }
}
