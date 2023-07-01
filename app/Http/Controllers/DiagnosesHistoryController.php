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

    public function __construct(DiagnosesHistoryServiceInterface $diagnosesHistoryService)
    {
        $this->diagnosesHistoryService = $diagnosesHistoryService;
    }


    function updateHistory(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'issue_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'accuracy' => ['required', 'numeric']
        ]);

        $this->diagnosesHistoryService->updateHistory($request->user_id, $request->issue_id, $request->name, $request->accuracy);

        return response()->json();
    }

    function getHistory(Request $request, $userId): JsonResponse
    {
        $request['user_id'] = $userId;
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);
        $history = $this->diagnosesHistoryService->getHistory($request->user_id);
        return response()->json();

    }
}