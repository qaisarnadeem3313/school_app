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

        // Create a default admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@school.edu',
        ]);

        // Create additional users
        User::factory()->create([
            'name' => 'Cashier User',
            'email' => 'cashier@school.edu',
        ]);

        // Seed the POS system data
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
        ]);
    }
}
