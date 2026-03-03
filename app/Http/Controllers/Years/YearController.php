<?php

namespace App\Http\Controllers\Years;

use App\Http\Controllers\Controller;
use App\Http\Requests\YearRequest;
use App\Models\Year;
use App\Services\TelegramLogger;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

final class YearController extends Controller
{
    public function index(): JsonResponse
    {
        $years = Year::all();

        return response()->json([
            'success' => true,
            'message' => 'Liste des années scolaires récupérée avec succès.',
            'data' => $years,
        ], status: Response::HTTP_OK);
    }

    public function store(YearRequest $request): JsonResponse
    {
        $user = auth()->user()->school;
        $data = $request->validated();
        $data['school_id'] = $user->id;
        $year = Year::create($data);
        (new TelegramLogger)->log('Annees scoaire activer avec sucees');

        return response()->json([
            'success' => true,
            'message' => 'Année scolaire créée avec succès.',
            'data' => $year,
        ], status: Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $year = Year::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Année scolaire récupérée avec succès.',
            'data' => $year,
        ], status: Response::HTTP_OK);
    }

    public function update(YearRequest $request, int $id): JsonResponse
    {
        $year = Year::findOrFail($id);
        $year->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Année scolaire mise à jour avec succès.',
            'data' => $year,
        ], status: Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $year = Year::findOrFail($id);
        $year->delete();

        return response()->json([
            'success' => true,
            'message' => 'Année scolaire supprimée avec succès.',
        ], status: Response::HTTP_OK);
    }

    public function activate(int $year): JsonResponse
    {
        $year = Year::findOrFail($year);
        Year::where('school_id', $year->school_id)
            ->where('id', '!=', $year->id)
            ->update(['is_active' => false]);

        $year->update(['is_active' => true]);
        (new TelegramLogger)->log("Annee scolaire $year activer avec succes");

        return response()->json([
            'success' => true,
            'message' => "Année scolaire $year->name activer avec succès",
            'data' => $year->fresh(),
        ], status: Response::HTTP_OK);
    }
}
