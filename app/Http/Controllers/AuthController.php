<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Services\TelegramLogger;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __invoke(AuthRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        $user = User::query()
            ->where('email', '=', $credentials['email'])
            ->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Informations invalides.',
            ], status: Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Authentification reussie .',
            'token' => $token,
        ], status: Response::HTTP_OK);
    }

    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $user->tokens()->delete();
        ((new TelegramLogger)->log('Deconnexion de l\'utilisateur'.$user->name.'reussie avec succes'));

        return response()->json([
            'message' => 'Deconexion reussie avec succees .',
            'success' => true,
        ], status: Response::HTTP_OK);
    }


}
