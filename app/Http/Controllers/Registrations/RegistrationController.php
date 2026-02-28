<?php

namespace App\Http\Controllers\Registrations;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Response;
use App\Models\Registration;

final class RegistrationController extends Controller
{
    public function index(): JsonResponse
    {
        $registrations = Registration::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des inscriptions récupérée avec succès.',
            'data' => $registrations,
        ], Response::HTTP_OK);
    }

    public function store(RegistrationRequest $request): JsonResponse
    {
        $registration = Registration::create($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Inscription créée avec succès.',
            'data' => $registration,
        ], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $registration = Registration::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'Inscription récupérée avec succès.',
            'data' => $registration,
        ], Response::HTTP_OK);
    }

    public function update(RegistrationRequest $request, int $id): JsonResponse
    {
        $registration = Registration::findOrFail($id);
        $registration->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Inscription mise à jour avec succès.',
            'data' => $registration,
        ], Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();
        return response()->json([
            'success' => true,
            'message' => 'Inscription supprimée avec succès.'
        ], Response::HTTP_OK);
    }
}
