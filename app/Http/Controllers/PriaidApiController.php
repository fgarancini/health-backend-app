<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\PriaidApiServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class PriaidApiController extends Controller
{
    /** @var PriaidApiServiceInterface $priaidApiService */
    protected $priaidApiService = null;

    public function __construct(PriaidApiServiceInterface $priaidApiService)
    {
        $this->priaidApiService = $priaidApiService;
    }

    function getSymptoms(): JsonResponse
    {
        $symptoms = $this->priaidApiService->getSymptoms();

        return response()->json(['data' => $symptoms]);
    }
}