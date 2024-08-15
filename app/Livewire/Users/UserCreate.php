<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{
    public $open_edit, $name, $email, $password, $rol;
    public $rules = [
        'name' => 'required',
        'password' => 'required|min:8',
        'email' => 'required|email',
        'rol' => 'required'
    ];

    public function updated($propertyName)
    { //Funcion para que se actualice en vivo las reglas de validacion cada vez que se corrija un input
        $this->validateOnly($propertyName);
    }
    
    public function render()
    {
        $roles = Role::all();
        return view('livewire.users.user-create', compact('roles'));
    }

    public function store()
    {
        $this->validate();
       
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
