<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Response;
use App\Models\Student;

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
        return response()->json([
            'success' => true,
            'message' => 'Étudiant supprimé avec succès.'
        ], Response::HTTP_OK);
    }
}
