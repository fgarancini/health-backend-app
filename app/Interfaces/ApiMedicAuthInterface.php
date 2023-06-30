<?php

namespace App\Interfaces;

interface ApiMedicAuthInterface{
    public function login();
    public function checkAndUpdateToken();
    public function getLastToken();
    public function hasExpired($token);
    public function saveToken($token);

}