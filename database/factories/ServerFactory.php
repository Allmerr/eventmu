<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Services\NicknameService;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Server>
 */
class ServerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::pluck('id')->all();

        $name = $this->faker->sentence(2);
        $nicknameService = new NicknameService();
        $nickname = $nicknameService->generateUniqueNickname($name);

        return [
            'name' => $name,
            'description' => $this->faker->text,
            'user_id' => $this->faker->randomElement($userId),
            'nickname' => $nickname,
        ];
    }
}
