<?php

namespace App\Services;

use App\Interfaces\ApiMedicAuthInterface;
use App\Models\PriaidAccessToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


class ApiMedicAuth implements ApiMedicAuthInterface
{
    private $uri;
    private $apiKey;
    private $secretKey;
    private $token = null;

    public function __construct()
    {
        $this->uri = config('services.priaid.auth_uri');
        $this->apiKey = config('services.priaid.api_key');
        $this->secretKey = config('services.priaid.secret_key');
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
            return $responseData;
        } else {
            $errorMessage = $response->body();
            return $errorMessage;
        }
    }

    public function checkAndUpdateToken()
    {
        $token = $this->getLastToken();

        if (!$token || $this->hasExpired($token)) {
            $newToken = $this->login();

            $this->saveToken($newToken);
            $token = $this->getLastToken();
        }

        return $token->token;
    }

    public function getLastToken()
    {
        return PriaidAccessToken::latest('created_at')->first();
    }

    public function hasExpired($token)
    {
        $expirationTime = Carbon::parse($token->validThrough);
        return $expirationTime->isPast();
    }

    public function saveToken($token)
    {
        PriaidAccessToken::create([
            'token' => $token['Token'],
            'validThrough' => Carbon::now()->addSeconds($token['ValidThrough']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}