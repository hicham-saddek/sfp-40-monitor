<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'slug' => 'admin',
            'description' => 'Administrateur',
            'enable' => true,
            'permissions' => ['*', '*.forceDelete', '*.view', '*.update', '*.delete', '*.create'],
        ]);
        Role::create([
            'slug' => 'ing',
            'description' => 'Ingénieur',
            'enable' => true,
            'permissions' => ['*.view', '*.update', '*.delete', '*.create'],
        ]);
        Role::create([
            'slug' => 'monitor',
            'description' => 'Moniteur de donnée',
            'enable' => true,
            'permissions' => ['*.view'],
        ]);
        Role::create([
            'slug' => 'etu',
            'description' => 'Étudiant',
            'enable' => true,
            'permissions' => ['*.view'],
        ]);
    }
}
