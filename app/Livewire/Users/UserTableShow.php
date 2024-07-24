<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UserTableShow extends Component
{
    public function render()
    {
        $usuarios = User::all();
        return view('livewire.users.user-table-show', compact('usuarios'));
    }
}
