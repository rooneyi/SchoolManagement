<?php

namespace App\Http\Controllers\Guardians;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardianRequest;
use Illuminate\Http\Response;
use App\Models\Guardian;

final class GuardianController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $guardians = Guardian::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des parents récupérée avec succès.',
            'data' => $guardians,
        ], Response::HTTP_OK);
    }

    public function store(GuardianRequest $request): \Illuminate\Http\JsonResponse
    {
        $guardian = Guardian::create($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Parent créé avec succès.',
            'data' => $guardian,
        ], Response::HTTP_CREATED);
    }

    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $guardian = Guardian::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'Parent récupéré avec succès.',
            'data' => $guardian,
        ], Response::HTTP_OK);
    }

    public function update(GuardianRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $guardian = Guardian::findOrFail($id);
        $guardian->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Parent mis à jour avec succès.',
            'data' => $guardian,
        ], Response::HTTP_OK);
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $guardian = Guardian::findOrFail($id);
        $guardian->delete();
        return response()->json([
            'success' => true,
            'message' => 'Parent supprimé avec succès.'
        ], Response::HTTP_OK);
    }
}
