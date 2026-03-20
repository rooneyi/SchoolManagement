<?php

namespace App\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseScheduleRequest;
use App\Models\Classroom;
use App\Models\CourseSchedule;
use App\Models\Employee;
use App\Models\Subject;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseScheduleWebController extends Controller
{
    public function index(Request $request): View
    {
        $classrooms = Classroom::with('section')->get();
        $selectedClassroom = null;
        $schedules = collect();

        if ($request->has('classroom_id') && $request->filled('classroom_id')) {
            $selectedClassroom = $classrooms->find($request->get('classroom_id'));

            if ($selectedClassroom) {
                $schedules = CourseSchedule::with(['subject', 'teacher'])
                    ->where('classroom_id', $selectedClassroom->id)
                    ->orderBy('day_of_week')
                    ->orderBy('start_time')
                    ->get();
            }
        }

        // Pour l'affichage en grille
        $days = [
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
            6 => 'Samedi',
            7 => 'Dimanche'
        ];

        $timeSlots = [];
        for ($i = 7; $i <= 18; $i++) {
            $timeSlots[] = sprintf('%02d:00', $i);
        }

        return view('schedules.index', compact('classrooms', 'selectedClassroom', 'schedules', 'days', 'timeSlots'));
    }

    public function create(Request $request): View
    {
        $classrooms = Classroom::with('section')->get();
        $selectedClassroom = null;

        if ($request->has('classroom_id')) {
            $selectedClassroom = $classrooms->find($request->get('classroom_id'));
        }

        $subjects = Subject::orderBy('name')->get();
        $teachers = Employee::where('status', 'active')->orderBy('last_name')->get();

        return view('schedules.create', compact('classrooms', 'selectedClassroom', 'subjects', 'teachers'));
    }

    public function store(CourseScheduleRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Vérification de chevauchement basique pour la classe
        $conflict = CourseSchedule::where('classroom_id', $data['classroom_id'])
            ->where('day_of_week', $data['day_of_week'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                      ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']])
                      ->orWhere(function ($q) use ($data) {
                          $q->where('start_time', '<=', $data['start_time'])
                            ->where('end_time', '>=', $data['end_time']);
                      });
            })
            ->exists();

        // On pourrait être plus strict et vérifier le chevauchement exact, mais ceci couvre la plupart des cas.
        // Attention: whereBetween inclut les bornes.

        // Vérification conflit prof
        if (!empty($data['employee_id'])) {
             $teacherConflict = CourseSchedule::where('employee_id', $data['employee_id'])
                ->where('day_of_week', $data['day_of_week'])
                ->where('id', '!=', 0) // Should be fine for create
                ->where(function ($query) use ($data) {
                    $query->where(function ($q) use ($data) {
                        $q->where('start_time', '<', $data['end_time'])
                          ->where('end_time', '>', $data['start_time']);
                    });
                })
                ->exists();

             if ($teacherConflict) {
                 return back()->withErrors(['employee_id' => 'Cet enseignant a déjà cours sur ce créneau.'])->withInput();
             }
        }

        if ($conflict) {
             // Affinons la vérification car whereBetween est inclusif
             // Si un cours finit à 10:00 et l'autre commence à 10:00, c'est OK.
             // La requete SQL ci-dessus est un peu large.

             // Check overlaps more precisely via collection filter if needed,
             // but let's trust a stricter query:
             $realConflict = CourseSchedule::where('classroom_id', $data['classroom_id'])
                ->where('day_of_week', $data['day_of_week'])
                ->where(function ($query) use ($data) {
                    $query->where(function ($q) use ($data) {
                        $q->where('start_time', '<', $data['end_time'])
                          ->where('end_time', '>', $data['start_time']);
                    });
                })
                ->exists();

             if ($realConflict) {
                 return back()->withErrors(['start_time' => 'Chevauchement d\'horaire détecté pour cette classe.'])->withInput();
             }
        }

        $schedule = CourseSchedule::create($data);

        (new TelegramLogger)->log('Cours planifié (web): '.$schedule->day_of_week.' '.$schedule->start_time);

        return redirect()->route('schedules.index', ['classroom_id' => $data['classroom_id']])
            ->with('success', 'Cours ajouté à l\'emploi du temps.');
    }

    public function destroy(CourseSchedule $schedule): RedirectResponse
    {
        $classroom_id = $schedule->classroom_id;
        $schedule->delete();
        (new TelegramLogger)->log('Cours supprimé du planning: #'.$schedule->id);

        return redirect()->route('schedules.index', ['classroom_id' => $classroom_id])
            ->with('success', 'Cours retiré.');
    }
}

