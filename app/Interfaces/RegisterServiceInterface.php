<?php

namespace App\Interfaces;

use App\Models\User;

interface RegisterServiceInterface
{
    function register(string $first_name, string $last_name, string $gender, string $birthdate, string $email, string $password): User;
}