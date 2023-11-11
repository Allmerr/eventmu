<?php

namespace App\Services;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Server;

class NicknameService{
    public function generateNickname(string $name): string
    {
        $nickname = '@' . Str::of($name)->lower()->replace(' ', '_')->substr(0, 13);
        return $nickname;
    }

    public function generateUniqueNickname(string $name): string
    {
        $nickname = $this->generateNickname($name);
        while (!$this->isUnique($nickname)) {
            $nickname = $this->generateNickname($name) . Str::random(3);
        }
        return $nickname;
    }

    public function isUnique(string $nickname): bool
    {
        $user = User::where('nickname', $nickname)->first();
        $server = Server::where('nickname', $nickname)->first();
        return is_null($user) && is_null($server);
    }
}
