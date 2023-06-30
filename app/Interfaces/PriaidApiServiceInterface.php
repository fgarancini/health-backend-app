<?php

namespace App\Interfaces;


interface PriaidApiServiceInterface{
    function getSymptoms();
    function getDiagnosis(int $userId,array $symptoms);
}