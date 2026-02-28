<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\TelegramLogger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

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
        (new TelegramLogger)->log('Nouveau utilisateur cree '.$payload['name'].$payload['email'].$payload['school_id'].' dans le cadre de votre compte.');

        return response()->json([
            'message' => 'Creation Utilisateur réussie .',
            'success' => true,
            'data' => $user,
        ], status: Response::HTTP_CREATED);
    }
}
