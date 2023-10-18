<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Server;
use App\Models\User;
use App\Models\Follower;

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
        // cant follow own server
        // cant follow twice the same server

        $user =  User::find($this->faker->randomElement(User::pluck('id')->all()));
        $server =  Server::find($this->faker->randomElement(Server::pluck('id')->all()));

        $isOwnServer = $user->id === $server->user_id;
        $isAlreadyFollowed = Follower::where('user_id', $user->id)->where('server_id', $server->id)->exists();

        while ($isOwnServer || $isAlreadyFollowed) {
            $user =  User::find($this->faker->randomElement(User::pluck('id')->all()));
            $server =  Server::find($this->faker->randomElement(Server::pluck('id')->all()));

            $isOwnServer = $user->id === $server->user_id;
            $isAlreadyFollowed = Follower::where('user_id', $user->id)->where('server_id', $server->id)->exists();
        }

        if(!$isOwnServer || !$isAlreadyFollowed){
            return [
                'user_id' => $user->id,
                'server_id' => $server->id,
            ];
        }

    }
}
