<?php

namespace App\Http\Controllers\Guardians;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardianRequest;
use App\Models\Guardian;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

final class GuardianController extends Controller
{
    public function index(): JsonResponse
    {
        $guardians = Guardian::all();

        return response()->json([
            'success' => true,
            'message' => 'Liste des parents récupérée avec succès.',
            'data' => $guardians,
        ], status: Response::HTTP_OK);
    }

    public function store(GuardianRequest $request): JsonResponse
    {
        $guardian = Guardian::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Parent créé avec succès.',
            'data' => $guardian,
        ], status: Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $guardian = Guardian::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Parent récupéré avec succès.',
            'data' => $guardian,
        ], status: Response::HTTP_OK);
    }

    public function update(GuardianRequest $request, int $id): JsonResponse
    {
        $guardian = Guardian::findOrFail($id);
        $guardian->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Parent mis à jour avec succès.',
            'data' => $guardian,
        ], status: Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $guardian = Guardian::findOrFail($id);
        $guardian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Parent supprimé avec succès.',
        ], status: Response::HTTP_OK);
    }
}
