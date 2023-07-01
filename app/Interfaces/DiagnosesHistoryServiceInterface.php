<?php

namespace App\Interfaces;

interface DiagnosesHistoryServiceInterface{
    function updateHistory(int $user_id,int $issue_id,string $name, float $accuracy);
    function getHistory(int $user_id);
}