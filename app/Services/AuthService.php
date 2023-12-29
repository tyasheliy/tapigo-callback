<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Faker\Core\Uuid;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService {
    public function registerUser(string $login, string $password): bool {
        if (User::query()
                ->where('login', '=', $login)
                ->exists())
        {
            return false;
        }

        $hash = bcrypt($password);

        $user = new User;
        $user->id = Str::uuid();
        $user->login = $login;
        $user->password = $hash;
        $user->save();

        return true;
    }

    public function authUser(string $login, string $password): string {
        $credentials = [
            'login' => $login,
            'password' => $password
        ];

        if (! $token = auth()->attempt($credentials)) {
            return "";
        }

        return $token;
    }
}