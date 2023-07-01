<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\DiagnosesHistoryServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiagnosesHistoryController extends Controller 
{
    /** @var \App\Interfaces\DiagnosesHistoryServiceInterface $diagnosesHistoryService */
    protected $diagnosesHistoryService = null;

    public function __construct(DiagnosesHistoryServiceInterface $diagnosesHistoryService) {
        $this->diagnosesHistoryService = $diagnosesHistoryService;
    }
    

    function updateHistory(Request $request) : JsonResponse {
        
    }
}
