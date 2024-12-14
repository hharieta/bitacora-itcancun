<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user =User::factory()->create([
            'name' => 'gatovsky',
            'email' => 'gatovsky@email.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            RoleSeeder::class,
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $user->roles()->attach($adminRole->id);
    }
}
