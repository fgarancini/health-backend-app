<?php

namespace App\Services;

use App\Interfaces\LoginServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginService implements LoginServiceInterface
{
    function login($email, $password)
    {
        $user = User::where('email', $email)->firstOrFail();

        if (!$user || !Auth::attempt(['email' => $email, 'password' => $password])) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return (object) [
            'token' => $token,
            'user' => $user
        ];
    }
    function logout($userId)
    {
        $user = Auth::user();

        if (!$user) {
            throw ValidationException::withMessages([
                'error' => ['Somthing went wrong!'],
            ]);
        }
        $currentAccessToken = $user->currentAccessToken();

        return $currentAccessToken->delete();
    }
}