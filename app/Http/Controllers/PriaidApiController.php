<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\PriaidApiServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;

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
        //Preguntar si ya existen los sintomas cacheados
        $symptoms = $this->priaidApiService->getSymptoms();

        return response()->json($symptoms,200);
    }

    function getDiagnosis(Request $request): JsonResponse
    {
        $request->validate([
            'userId' => ['required', 'exists:users,id'],
            'symptoms' => ['required', 'array'],
            'symptoms.*' => ['integer'],
        ]);
        $diagnosis = $this->priaidApiService->getDiagnosis($request->userId, $request->symptoms);

        return response()->json($diagnosis);
    }
}