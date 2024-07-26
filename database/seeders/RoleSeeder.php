<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role = Role::create(['name' => 'Admin']);
        $role1= Role::create(['name' => 'Analist']);

        /* Artificios */
        $permission = Permission::create(['name' => 'dashboard.Artificios'])->syncRoles([$role, $role1]); //Ver artificio
        $permission = Permission::create(['name' => 'Artificios.store'])->assignRole($role); //Agregar artificio
        $permission = Permission::create(['name' => 'Artificios.show'])->syncRoles([$role, $role1]);; //Ver artificios
        $permission = Permission::create(['name' => 'Artificios.update'])->assignRole($role); //editar artificio
        $permission = Permission::create(['name' => 'Artificios.destroy'])->assignRole($role); //Eliminar artificio
        /* Coordinaciones */
        $permission = Permission::create(['name' => 'dashboard.Coordinaciones']); //Ver coordinacines
        $permission = Permission::create(['name' => 'Coordinaciones.store'])->assignRole($role); //Agregar coordinacines
        $permission = Permission::create(['name' => 'Coordinaciones.show'])->syncRoles([$role, $role1]); //Ver coordinacines
        $permission = Permission::create(['name' => 'Coordinaciones.update'])->assignRole($role); //editar coordinacines
        $permission = Permission::create(['name' => 'Coordinaciones.destroy'])->assignRole($role); //Eliminar coordinacines
        /* Stock */
        $permission = Permission::create(['name' => 'dashboard.Stock'])->syncRoles([$role, $role1]); //Ver Stock
        $permission = Permission::create(['name' => 'Stock.store'])->assignRole($role); //Agregar Stock
        $permission = Permission::create(['name' => 'Stock.show'])->assignRole($role);//Ver Stock
        $permission = Permission::create(['name' => 'Stock.update'])->assignRole($role); //editar Stock
        $permission = Permission::create(['name' => 'Stock.destroy'])->assignRole($role); //Eliminar Stock
        /* User */
        $permission = Permission::create(['name' => 'dashboard.usuario'])->syncRoles([$role]); //Ver Stock
        $permission = Permission::create(['name' => 'user.store'])->assignRole($role); //Agregar Stock
        $permission = Permission::create(['name' => 'user.show'])->assignRole($role);//Ver Stock
        $permission = Permission::create(['name' => 'user.update'])->assignRole($role); //editar Stock
        $permission = Permission::create(['name' => 'user.destroy'])->assignRole($role); //Eliminar Stock

    }
}
