<?php

use App\Http\Controllers\DiagnosesHistoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PriaidApiController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/app/register', [RegisterController::class, 'register']);

Route::post('/app/login', [LoginController::class, 'login']);

Route::post('/app/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/app/symptoms', [PriaidApiController::class, 'getSymptoms']);
    Route::post('/app/diagnosis', [PriaidApiController::class, 'getDiagnosis']);
    Route::post('/app/history', [DiagnosesHistoryController::class, 'updateHistory']);
    Route::get('/app/history/{userId}', [DiagnosesHistoryController::class, 'getHistory']);
});