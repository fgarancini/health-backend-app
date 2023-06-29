<?php

namespace App\Interfaces;

interface ApiMedicAuthInterface{
    public function login();
    public function getToken();
}