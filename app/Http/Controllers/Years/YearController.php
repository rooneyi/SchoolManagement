<?php

namespace App\Http\Controllers\Years;

use App\Http\Controllers\Controller;
use App\Http\Requests\YearRequest;
use Illuminate\Http\Response;
use App\Models\Year;

final class YearController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $years = Year::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des années scolaires récupérée avec succès.',
            'data' => $years,
        ], Response::HTTP_OK);
    }

    public function store(YearRequest $request): \Illuminate\Http\JsonResponse
    {
        $year = Year::create($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Année scolaire créée avec succès.',
            'data' => $year,
        ], Response::HTTP_CREATED);
    }

    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $year = Year::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'Année scolaire récupérée avec succès.',
            'data' => $year,
        ], Response::HTTP_OK);
    }

    public function update(YearRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $year = Year::findOrFail($id);
        $year->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Année scolaire mise à jour avec succès.',
            'data' => $year,
        ], Response::HTTP_OK);
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $year = Year::findOrFail($id);
        $year->delete();
        return response()->json([
            'success' => true,
            'message' => 'Année scolaire supprimée avec succès.'
        ], Response::HTTP_OK);
    }
}
