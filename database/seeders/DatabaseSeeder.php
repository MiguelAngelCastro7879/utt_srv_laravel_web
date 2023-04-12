<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        User::factory()->create([
            'name' => 'Miguel Angel Castro',
            'email' => 'mikeangel7879@gmail.com',
            'password' => Hash::make('1234567890'),
            'role_id' => '0'
        ]);
        User::factory()->create([
            'name' => 'Supervisor',
            'email' => 'supervisor@gmail.com',
            'password' => Hash::make('1234567890'),
            'role_id' => '1'
        ]);
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'Administrador@gmail.com',
            'password' => Hash::make('1234567890'),
            'role_id' => '2'
        ]);
    }
}
