<?php

namespace App\Services;

use App\Interfaces\DiagnosesHistoryServiceInterface;
use App\Models\User;
use App\Models\UserDiagnosesHistory;


class DiagnosesHistoryService implements DiagnosesHistoryServiceInterface
{
    function updateHistory(int $user_id, int $issue_id, string $name, float $accuracy)
    {

        // Its possible to add the same issue to the same user multiple times
        // Constrain in the UserDiagnosesHistory is needed

        $user = User::find($user_id);
        if (!$user) {
            throw new \Exception("User not found");
        }
        UserDiagnosesHistory::create([
            'user_id' => $user_id,
            'issue_id' => $issue_id,
            'name' => $name,
            'accuracy' => $accuracy,
        ]);
    }

    function getHistory(int $user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            throw new \Exception("User not found");
        }
        return $user->diagnosesHistory;
    }

}