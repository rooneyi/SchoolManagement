<?php

namespace App\Http\Controllers\Registrations;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\Classroom;
use App\Models\Guardian;
use App\Models\Registration;
use App\Models\School;
use App\Models\Section;
use App\Models\Student;
use App\Models\Year;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationWebController extends Controller
{
    public function index(): View
    {
        $registrations = Registration::with(['student', 'guardian', 'school', 'year', 'classroom', 'section'])->latest()->get();

        return view('registrations.index', compact('registrations'));
    }

    public function create(): View
    {
        $students = Student::all();
        $guardians = Guardian::all();
        $schools = School::all();
        $years = Year::all();
        $classrooms = Classroom::all();
        $sections = Section::all();

        return view('registrations.create', compact('students', 'guardians', 'schools', 'years', 'classrooms', 'sections'));
    }

    public function store(RegistrationRequest $request): RedirectResponse
    {
        $registration = Registration::create($request->validated());
        (new TelegramLogger)->log('Nouvelle inscription créée (web): '.$registration->id);

        return redirect()->route('registrations.index')->with('success', 'Inscription créée avec succès');
    }

    public function edit(Registration $registration): View
    {
        $students = Student::all();
        $guardians = Guardian::all();
        $schools = School::all();
        $years = Year::all();
        $classrooms = Classroom::all();
        $sections = Section::all();

        return view('registrations.edit', compact('registration', 'students', 'guardians', 'schools', 'years', 'classrooms', 'sections'));
    }

    public function update(RegistrationRequest $request, Registration $registration): RedirectResponse
    {
        $registration->update($request->validated());
        (new TelegramLogger)->log('Inscription mise à jour (web): '.$registration->id);

        return redirect()->route('registrations.index')->with('success', 'Inscription mise à jour avec succès');
    }

    public function changeStatus(Request $request, Registration $registration): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|max:50',
        ]);

        $oldStatus = $registration->status;
        $registration->update(['status' => $validated['status']]);

        (new TelegramLogger)->log("Statut inscription #{$registration->id} changé (web): {$oldStatus} -> {$registration->status}");

        return redirect()->route('registrations.index')->with('success', 'Statut de l’inscription mis à jour avec succès');
    }

    public function destroy(Registration $registration): RedirectResponse
    {
        $id = $registration->id;
        $registration->delete();
        (new TelegramLogger)->log('Inscription supprimée (web): '.$id);

        return redirect()->route('registrations.index')->with('success', 'Inscription supprimée avec succès');
    }
}
