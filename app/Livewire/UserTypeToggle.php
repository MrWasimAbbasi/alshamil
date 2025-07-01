<?php

namespace App\Livewire;

use Livewire\Component;

class UserTypeToggle extends Component
{
    public $userType = 'normal';

    public function updatedUserType(): void
    {
        $this->dispatch('userTypeUpdated', $this->userType);
    }

    public function render()
    {
        return view('livewire.user-type-toggle');
    }
}
