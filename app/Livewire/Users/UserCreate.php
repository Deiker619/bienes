<?php

namespace App\Livewire\Users;

use Livewire\Component;

class UserCreate extends Component
{
    public $open_edit;
    public function render()
    {
        return view('livewire.users.user-create');
    }
}
