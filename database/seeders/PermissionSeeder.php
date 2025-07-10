<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $permiso = [
            'categorias',           
            'componentes',
            'equipos',
            'inventario',            
            'panel',
            'panel_agregar_solo_asesores',
            'panel_agregar_todos',
            'personal',
            'perfilpersonal',
            'perfilpasw',
            'agregar_solo_mobiliario',
            'agregar_solo_electronico',

            'agregar_todo', 



        ];
       
 

        foreach ($permiso as $permisos) {
            Permission::create(['name' => $permisos]); // Use $permisos here, not $permiso
        }
    }
}
