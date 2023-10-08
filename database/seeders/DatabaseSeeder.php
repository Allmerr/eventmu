<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Muhammad Kevin Almer',
            'email' => 'kevinalmer4@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
