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
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Admin Name',
            'last_name' => 'Admin LastName',
            'email' => 'admin@mail.com', 
            'is_admin' => true,
        ]);

        User::factory()->create([
            'first_name' => 'User Name',
            'last_name' => 'User LastName',
            'email' => 'user@mail.com', 
            'is_admin' => false,
        ]);

        User::factory()
            ->count(20)
            ->create([
                'is_admin' => false,
            ]); 
    }
}
