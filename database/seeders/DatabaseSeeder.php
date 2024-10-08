<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            RoleAndPermissionSeeder::class,
        ]);

        $user =  User::factory()->create([
            'name' => 'Test User',
            'email' => 'superadmin@gmail.com',
        ]);

        $user->assignRole('super-admin');

        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'adminuser@example.com',
            'password' => bcrypt('password'),
        ]);

        $adminUser->assignRole('admin');
    }
}
