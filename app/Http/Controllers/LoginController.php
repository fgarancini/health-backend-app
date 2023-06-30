<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use App\Interfaces\LoginServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /** @var LoginServiceInterface $loginService  */
    protected $loginService;
    public function __construct(LoginServiceInterface $loginService)
    {
        $this->loginService = $loginService;
    }

    function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string']
        ]);

        $userData = $this->loginService->login($request->email, $request->password);

        return response()->json(['data' => new LoginResource($userData)], 200);
    }

    function logout(Request $request): JsonResponse
    {
        $request->validate([
            'userId' => ['required', 'exists:users,id']
        ]);

        $this->loginService->logout($request->userId);

        return response()->json([], 200);
    }
}