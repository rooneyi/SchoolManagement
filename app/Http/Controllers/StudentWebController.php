<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\School;
use App\Models\Guardian;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentWebController extends Controller
{
    public function index(): View
    {
        $students = Student::with(['school', 'guardian'])->get();

        return view('students.index', compact('students'));
    }

    public function create(): View
    {
        $schools = School::all();
        $guardians = Guardian::all();

        return view('students.create', compact('schools', 'guardians'));
    }

    public function store(StudentRequest $request): RedirectResponse
    {
        $student = Student::create($request->validated());
        (new TelegramLogger)->log('Nouvel élève créé (web): '.$student->name);

        return redirect()->route('students.index')->with('success', 'Élève créé avec succès');
    }

    public function edit(Student $student): View
    {
        $schools = School::all();
        $guardians = Guardian::all();

        return view('students.edit', compact('student', 'schools', 'guardians'));
    }

    public function update(StudentRequest $request, Student $student): RedirectResponse
    {
        $student->update($request->validated());
        (new TelegramLogger)->log('Élève mis à jour (web): '.$student->name);

        return redirect()->route('students.index')->with('success', 'Élève mis à jour avec succès');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $name = $student->name;
        $student->delete();
        (new TelegramLogger)->log('Élève supprimé (web): '.$name);

        return redirect()->route('students.index')->with('success', 'Élève supprimé avec succès');
    }
}
