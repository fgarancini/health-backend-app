<?php

namespace App\Services;

use App\Interfaces\DiagnosesHistoryServiceInterface;
use App\Models\User;
use App\Models\UserDiagnosesHistory;


class DiagnosesHistoryService implements DiagnosesHistoryServiceInterface
{
    function updateHistory(int $user_id, int $issue_id, string $name, float $accuracy)
    {
        $user = User::find($user_id);
        if (!$user) {
            UserDiagnosesHistory::create([
            'user_id' => $user_id,
            'issue_id' => $issue_id,
            'name' => $name,
            'accuracy' => $accuracy,
        ]);
        }
    }

    function getHistory(int $user_id){

        return User::find($user_id)->diagnosesHistory;
    }

}