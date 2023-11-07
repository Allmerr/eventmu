<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Server;
use App\Models\Follower;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Muhammad Kevin Almer',
            'email' => 'kevinalmer4@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Kerin Dwi Almira',
            'email' => 'kerin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        Server::factory()->count(4)->create();
        // Follower::factory()->count(5)->create();
    }
}
