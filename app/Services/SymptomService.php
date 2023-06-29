<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SymptomService
{

    /** @var ApiMedicAuth $autorizedInstance description */
    private $autorizedInstance = null;

    private $token = null;

    public function __construct(ApiMedicAuth $autorizedInstance)
    {
        $this->autorizedInstance = $autorizedInstance;
        $this->autorizedInstance->login();
    }
    


    function getSymptoms()
    {
        $token = $this->autorizedInstance->getToken();
        return Http::withHeaders([
            'Authorization' => $token
        ])->withQueryParameters([
                    'token' => $token,
                    'symptoms' => [],
                    'language' => 'en-gb',
                ])->get("https://healthservice.priaid.ch/symptoms");
    }

}