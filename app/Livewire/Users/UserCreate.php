<?php

namespace App\Livewire\Users;

use App\Models\User;
use FontLib\Table\Type\name;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{
    
    public $open_edit, $name, $email, $password, $rol;
    public function render()
    {
        $roles = Role::all();
        return view('livewire.users.user-create', compact('roles'));
    }

    public function store()
    {
       
        $create = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ])->roles()->sync($this->rol);

        if ($create) {
            $this->dispatch('artificioAdded', 'Usuario ' . $this->name . ' creado exitosamente');
            $this->reset(['name', 'email', 'password']);
            $this->open_edit = false;
        } else {
            $this->dispatch('error', "No se pudo crear el usuario");
        }
    }
}
