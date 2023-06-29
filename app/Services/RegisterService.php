<?php

namespace App\Services;

use App\Models\User;
use App\Interfaces\RegisterServiceInterface;
use Illuminate\Support\Facades\Hash;


class RegisterService implements RegisterServiceInterface
{
    function register(string $first_name, string $last_name, string $gender, string $birthdate, string $email, string $password): User
    {
        $passwordEncrypted = Hash::make($password);
        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'birthdate' => $birthdate,
            'email' => $email,
            'password' => $passwordEncrypted
        ]);

        return $user;
    }
}