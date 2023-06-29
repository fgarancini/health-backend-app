<?php

namespace App\Services;
use App\Interfaces\ApiMedicAuthInterface;
use Illuminate\Support\Facades\Http;


class ApiMedicAuth implements ApiMedicAuthInterface{
    private $uri;
    private $apiKey;
    private $secretKey;
    private $token = null;

    public function __construct($uri, $apiKey, $secretKey)
    {
        $this->uri = $uri;
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
    }

    public function login()
    {
        $secretBytes = utf8_encode($this->secretKey);
        $computedHashString = '';

        $hmac = hash_hmac('md5', $this->uri, $secretBytes, true);
        $computedHashString = base64_encode($hmac);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey . ':' . $computedHashString,
        ])->post($this->uri);

        if ($response->ok()) {
            $responseData = $response->json();
            $this->token = $responseData['Token'];
        } else {
            $errorMessage = $response->body();
            return $errorMessage;
        }
    }

    function getToken() {
        return $this->token;
    }

}