<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UserTableShow extends Component
{
    public $open_edit, $nombre, $ide, $email, $roles;
    public function render()
    {
        $usuarios = User::all();
        return view('livewire.users.user-table-show', compact('usuarios'));
    }

    public function edit($id){
        $this->open_edit = true;
        $registro = User::findOrfail($id);
        
        $this->nombre = $registro->name;
        $this->ide = $registro->id;
        $this->email = $registro->email;
    }

    public function update()
    {
        
        $registro = User::find($this->ide);
        $registro->fill($this->all());
        $registro->save();


        $registro->roles()->sync($this->roles);

        $this->open_edit = false;
        $this->dispatch('artificioAdded', 'Se modificó este usuario');
    }
}
