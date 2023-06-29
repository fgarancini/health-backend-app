<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\RegisterServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterController extends Controller
{
    /** @var RegisterServiceInterface $registerService  */
    private $registerService;

    public function __construct(RegisterServiceInterface $registerService)
    {
        $this->registerService = $registerService;
    }

    function register(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'gender' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
            'email' => ['required', 'email', 'string', 'unique:users,email'],
            'password' => [
                'required', Password::min(8)->letters()
                // ->mixedCase()
                // ->numbers()
                // ->symbols()
            ]
        ]);


        $this->registerService->register(
            $request->first_name,
            $request->last_name,
            $request->gender,
            $request->birthdate,
            $request->email,
            $request->password
        );

        return response()->json('',204);
    }

    function validateEmail(Request $request): JsonResponse
    {
        $validatedEmail = $request->validate([
            'email' => ['required', 'email', 'unique:users,email']
        ]);

        return response()->json();
    }
}