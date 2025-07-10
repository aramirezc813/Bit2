<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role ;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             // Crear el usuario
             $user = User::create([
            'name' => '1',/* Ana Karla Ramirez */
            'email' => 'aramirezc813@gmail.com',
            'password' => bcrypt('123456')
        ]);    

           // Crear el rol administrador
         $rol = Role::create(['name' => 'Admin']);

        // Obtener todos los permisos
        $permisos = Permission::pluck('id', 'id')->all(); 

        // Sincronizar permisos con el rol
         $rol->syncPermissions($permisos); 
        $user =User::find(1);

        // Asignar el rol administrador al usuario recién creado
        $user->assignRole('Admin');    
    }
}
