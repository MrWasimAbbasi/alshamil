<?php

namespace App\Livewire;

use Livewire\Component;

class UserTypeToggle extends Component
{
    public $userType;

    public function updatedUserType()
    {
        $this->dispatch('user-type-updated', type: $this->userType);
    }


    public function render()
    {
        return view('livewire.user-type-toggle');
    }
}
