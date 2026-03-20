<?php

namespace App\Http\Controllers\Teachings;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Employee;
use App\Models\Subject;
use App\Models\Teaching;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeachingWebController extends Controller
{
    /**
     * Affiche la liste des enseignements, filtrable par classe.
     */
    public function index(Request $request): View
    {
        $selectedClassroom = null;
        $classrooms = Classroom::with('section')->get();

        $teachings = Teaching::query()
            ->with(['classroom.section', 'subject', 'teacher']);

        if ($request->has('classroom_id') && $request->get('classroom_id')) {
            $teachings->where('classroom_id', $request->get('classroom_id'));
            $selectedClassroom = $classrooms->find($request->get('classroom_id'));
        } else {
            // Pour ne pas charger tous les enseignements de l'école d'un coup si pas de filtre
            // On peut soit paginer, soit demander de choisir une classe.
            // Allons pour une liste vide au départ ou paginate
            $teachings->latest();
        }

        $teachings = $teachings->paginate(20)->withQueryString();

        return view('teachings.index', compact('teachings', 'classrooms', 'selectedClassroom'));
    }

    /**
     * Formulaire d'assignation
     */
    public function create(Request $request): View
    {
        $classrooms = Classroom::with('section')->get();
        $subjects = Subject::all();
        // Filtre les employés qui ont un rôle 'teacher' ou tout le monde ?
        // Prenons tout le monde pour l'instant ou filtrons si on avait un scope.
        // Idéalement Employee::where('job_title', 'like', '%enseignant%') ou via le user role.
        $teachers = Employee::where('status', 'active')->orderBy('last_name')->get();

        $selectedClassroom = null;
        if ($request->has('classroom_id')) {
            $selectedClassroom = $classrooms->find($request->get('classroom_id'));
        }

        return view('teachings.create', compact('classrooms', 'subjects', 'teachers', 'selectedClassroom'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'classroom_id' => ['required', 'exists:classrooms,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'employee_id' => ['required', 'exists:employees,id'],
            'total_hours' => ['nullable', 'integer', 'min:1'],
            'credits' => ['nullable', 'integer', 'min:1'],
        ]);

        // Vérifier doublon
        $exists = Teaching::where('classroom_id', $validated['classroom_id'])
            ->where('subject_id', $validated['subject_id'])
            ->where('employee_id', $validated['employee_id'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['subject_id' => 'Ce cours est déjà assigné à cet enseignant pour cette classe.'])->withInput();
        }

        $teaching = Teaching::create($validated);

        (new TelegramLogger)->log('Assignation cours (web): Classe #'.$teaching->classroom_id.' - Mat #'.$teaching->subject_id);

        return redirect()->route('teachings.index', ['classroom_id' => $teaching->classroom_id])
            ->with('success', 'Cours assigné avec succès.');
    }

    public function destroy(Teaching $teaching): RedirectResponse
    {
        $classroom_id = $teaching->classroom_id;
        $teaching->delete();
        (new TelegramLogger)->log('Assignation supprimée (web): #'.$teaching->id);

        return redirect()->route('teachings.index', ['classroom_id' => $classroom_id])
            ->with('success', 'Assignation supprimée.');
    }
}

