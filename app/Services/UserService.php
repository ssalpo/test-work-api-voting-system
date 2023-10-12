<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public const AVATARS_PATH = 'public/avatars/participant';

    public function register(array $data)
    {
        $data['avatar'] = $data['avatar']?->store(self::AVATARS_PATH);

        return User::create(
            $data + ['password' => Hash::make($data['password'])]
        );
    }

    public function generateTokenByEmail(string $email)
    {
        $user = User::where('email', $email)->firstOrFail();

        return $user->createToken('auth_token')->plainTextToken;
    }
}
