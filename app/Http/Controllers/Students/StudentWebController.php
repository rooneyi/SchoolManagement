<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Guardian;
use App\Models\School;
use App\Models\Student;
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
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students/photos', 'public');
        }

        if ($request->hasFile('bulletin_file')) {
            $data['bulletin_file'] = $request->file('bulletin_file')->store('students/bulletins', 'public');
        }

        $student = Student::create($data);
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
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students/photos', 'public');
        }

        if ($request->hasFile('bulletin_file')) {
            $data['bulletin_file'] = $request->file('bulletin_file')->store('students/bulletins', 'public');
        }

        $student->update($data);
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
