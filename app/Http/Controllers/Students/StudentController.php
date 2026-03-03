<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Services\TelegramLogger;
use Illuminate\Http\Response;

final class StudentController extends Controller
{
    public function index(): JsonResponse
    {
        $students = Student::all();

        return response()->json([
            'success' => true,
            'message' => 'Liste des étudiants récupérée avec succès.',
            'data' => $students,
        ], Response::HTTP_OK);
    }

    public function store(StudentRequest $request): JsonResponse
    {
        $student = Student::create($request->validated());
        (new TelegramLogger)->log('Étudiant créé: '.$student->id);

        return response()->json([
            'success' => true,
            'message' => 'Étudiant créé avec succès.',
            'data' => $student,
        ], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $student = Student::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Étudiant récupéré avec succès.',
            'data' => $student,
        ], Response::HTTP_OK);
    }

    public function update(StudentRequest $request, int $id): JsonResponse
    {
        $student = Student::findOrFail($id);
        $student->update($request->validated());
        (new TelegramLogger)->log('Étudiant mis à jour: '.$student->id);

        return response()->json([
            'success' => true,
            'message' => 'Étudiant mis à jour avec succès.',
            'data' => $student,
        ], Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $student = Student::findOrFail($id);
        $student->delete();
        (new TelegramLogger)->log('Étudiant supprimé: '.$id);

        return response()->json([
            'success' => true,
            'message' => 'Étudiant supprimé avec succès.',
        ], Response::HTTP_OK);
    }
}
