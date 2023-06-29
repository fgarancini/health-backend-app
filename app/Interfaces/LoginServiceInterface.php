<?php

namespace App\Interfaces;

interface LoginServiceInterface
{
    function login($email, $password);
    function logout($userId);
}