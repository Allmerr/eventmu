<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Server;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Folower>
 */
class FollowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = $this->faker->randomElement(User::pluck('id')->all());

        $server = Server::find($this->faker->randomElement(Server::pluck('id')->all()));

        while($server->user_id == $userId){
            $server = Server::find($this->faker->randomElement(Server::pluck('id')->all()));
        }

        return [
            'server_id' => $server->id,
            'user_id' => $userId,
        ];
    }
}
