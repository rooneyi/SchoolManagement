<?php

namespace App\Http\Controllers\Registrations;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\Registration;
use App\Services\TelegramLogger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        (new TelegramLogger)->log('Inscription créée: '.$registration->id);

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
        (new TelegramLogger)->log('Inscription mise à jour: '.$registration->id);

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
        (new TelegramLogger)->log('Inscription supprimée: '.$id);

        return response()->json([
            'success' => true,
            'message' => 'Inscription supprimée avec succès.',
        ], Response::HTTP_OK);
    }

    public function changeStatus(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|max:50',
        ]);

        $registration = Registration::findOrFail($id);
        $registration->status = $validated['status'];
        $registration->save();

        (new TelegramLogger)->log("Inscription #{$id} statut changé en {$registration->status}");

        return response()->json([
            'success' => true,
            'message' => 'Statut de l’inscription mis à jour.',
            'data' => $registration,
        ], Response::HTTP_OK);
    }

    public function byStudent(int $studentId): JsonResponse
    {
        $registrations = Registration::where('student_id', $studentId)->get();

        return response()->json([
            'success' => true,
            'message' => 'Inscriptions de l’étudiant récupérées.',
            'data' => $registrations,
        ], Response::HTTP_OK);
    }
}
