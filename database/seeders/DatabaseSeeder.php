<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\GameModel;
use App\Models\CategoryModel;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Roles::factory()->create([
            'name'=>'Usuario'
        ]);
        
        Roles::factory()->create([
            'name'=>'Supervisor'
        ]);
        
        Roles::factory()->create([
            'name'=>'Administrador'
        ]);

        CategoryModel::factory()->create([
            'name' => 'Deportes',
            'description' => 'Futbol,Basquet,Tennis',
            'status' => 'true'
        ]);

        CategoryModel::factory()->create([
            'name' => 'Accion',
            'description' => 'Disparos,Pelea',
            'status' => 'true'
        ]);

        CategoryModel::factory()->create([
            'name' => 'Plataforma',
            'description' => 'MarioBros, Blockthunder',
            'status' => 'true'
        ]);

        User::factory()->create([
            'name' => 'Miguel Angel Castro',
            'email' => 'mikeangel7879@gmail.com',
            'password' => Hash::make('1234567890'),
            'role_id' => '1'
        ]);
        User::factory()->create([
            'name' => 'PedroDSM',
            'email' => 'pedro.dsm124@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => '1'
        ]);
        User::factory()->create([
            'name' => 'Supervisor',
            'email' => 'supervisor@gmail.com',
            'password' => Hash::make('1234567890'),
            'role_id' => '2'
        ]);
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'Administrador@gmail.com',
            'password' => Hash::make('1234567890'),
            'role_id' => '3'
        ]);
    }
}
