<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use function rand;

class DatabaseSeeder extends Seeder
{
    public function randomRoles(): Collection|array
    {
        return Role::query()->inRandomOrder()->withoutGlobalScopes()->get()->shuffle()->random(rand(1, $this->rolesCount()))->pluck('id');
    }

    public function rolesCount(): int
    {
        return Role::query()->count();
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        User::factory(10)->create()->each(function (User $user){
            $user->roles()->attach($this->randomRoles());
        });
        $this->call([
            ChannelSeeder::class,
            VariableSeeder::class,
            DataSeeder::class,
        ]);
        $this->createSuperAdmin();
    }

    public function createSuperAdmin()
    {
        User::create([
            'name' => 'Hicham SADDEK',
            'email' => 'hicham.saddek9@etu.univ-lorraine.fr',
            'password' => Hash::make('password'),
        ])->roles()->attach(Role::slug('admin')->first());
    }
}
