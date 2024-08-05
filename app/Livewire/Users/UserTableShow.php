<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;


class UserTableShow extends Component
{
    protected $listeners = ['artificioAdded' => 'artificioAdded'];

    
    public $open_edit, $open_roles, $name, $ide, $email, $rol, $r;
    #[On('artificioAdded')]
    public function render()
    {
        $usuarios = User::all();

        return view('livewire.users.user-table-show', compact('usuarios'));
    }

    public function edit($id){
        $this->open_edit = true;
        $registro = User::findOrfail($id);
      /*   $this->rol = $registro->roles->first(); */
        
        $this->name = $registro->name;
        $this->ide = $registro->id;
        $this->email = $registro->email;
    }

   

    public function update()
    {
        
        $registro = User::find($this->ide);
        $registro->fill($this->all());
        $registro->save();
        
            /* $registro->roles()->sync($this->roles); */
     

        $this->open_edit = false;
        $this->dispatch('artificioAdded', 'Se modificó este usuario');
    }

    public function editRoles($id){
        $this->open_roles = true;
        $roles = User::findOrfail($id);

        $this->rol = $roles->roles->first();
        $this->ide = $roles->id;
    }


    public function updateRoles(){

        $roles = User::find($this->ide);
        $roles->roles()->sync($this->r);

        $this->open_roles = false;
        $this->dispatch('artificioAdded', 'Se modificó este usuario');
    }

    public function destroy($id){
        $usuario = user::findOrFail($id);
        $usuario->delete();

        $this->dispatch('artificioAdded', 'Usuario eliminado');

    }
}
