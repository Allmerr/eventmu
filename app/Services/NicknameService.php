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
        $user = User::where('nickname', $nickname)->where('is_deleted', '0')->first();
        $server = Server::where('nickname', $nickname)->where('is_deleted', '0')->first();
        return is_null($user) && is_null($server);
    }

    public function findNickname(string $nickname)
    {
        $user = User::where('nickname', $nickname)->where('is_deleted', '0')->first();
        $server = Server::where('nickname', $nickname)->where('is_deleted', '0')->first();
        if (!is_null($user)) {
            return [
                'type' => 'user',
                'user' => $user,
            ];
        } else if (!is_null($server)) {
            return [
                'type' => 'server',
                'server' => $server,
            ];
        } else {
            return null;
        }
    }
}
