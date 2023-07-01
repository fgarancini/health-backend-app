<?php

namespace App\Services;

use App\Interfaces\PriaidApiServiceInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PriaidApiService implements PriaidApiServiceInterface
{

    /** @var ApiMedicAuth $autorizedInstance description */
    private $autorizedInstance = null;

    private $token = null;

    public function __construct(ApiMedicAuth $autorizedInstance)
    {
        $this->autorizedInstance = $autorizedInstance;
        $this->token = $this->autorizedInstance->checkAndUpdateToken();
    }

    function getSymptoms()
    {
        $cacheKey = 'symptoms';
        $expirationTimeInSeconds = 3600; 
    
        
        $cachedResponse = Cache::remember($cacheKey, $expirationTimeInSeconds, function () {
            return Http::withHeaders([
                'Authorization' => "Bearer " . $this->token
            ])->get("https://sandbox-healthservice.priaid.ch/symptoms",[
                'token' => $this->token,
                'symptoms' => [],
                'language' => 'en-gb',
            ])->json();
        });
    
        return $cachedResponse;
    }

    function getDiagnosis($userId,$symptoms) 
    {
        $user = User::find($userId);
        $yearOfBirth = Carbon::parse($user->birthdate);
        return Http::withHeaders([
            'Authorization' => "Bearer " . $this->token
        ])->get("https://sandbox-healthservice.priaid.ch/diagnosis",[
            'token' => $this->token,
            'symptoms' => json_encode($symptoms),
            'gender' => $user->gender,
            'year_of_birth' => $yearOfBirth->year,
            'language' => 'en-gb',
        ])->json();
    }

}