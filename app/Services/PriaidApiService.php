<?php

namespace App\Services;

use App\Interfaces\PriaidApiServiceInterface;
use Illuminate\Support\Facades\Http;

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
        return Http::withHeaders([
            'Authorization' => "Bearer " . $this->token
        ])->get("https://sandbox-healthservice.priaid.ch/symptoms",[
            'token' => $this->token,
            'symptoms' => [],
            'language' => 'en-gb',
        ])->json();
    }

}