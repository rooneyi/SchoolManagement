<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {

        $requestData = $request->validated();
        $schoolCreator = Auth::user()->school_id;
        $payload = [
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
            'school_id' => $schoolCreator,

        ];
        $user = User::query()->create($payload);
        $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Authentification reussie .',
            'success' => true,
            'data' => $user,
        ]);
    }
}
