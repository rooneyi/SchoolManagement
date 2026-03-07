<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Classroom;
use App\Models\Registration;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $schoolCount = School::count();
        $studentCount = Student::count();
        $guardianCount = Guardian::count();
        $classroomCount = Classroom::count();

        // Inscriptions par mois (pour le graphique linéaire)
        $driver = DB::connection()->getDriverName();
        $monthExpression = $driver === 'sqlite'
            ? "strftime('%m', registration_date)"
            : "MONTH(registration_date)";

        $registrationsByMonth = Registration::select(
            DB::raw('count(id) as total'),
            DB::raw("$monthExpression as month")
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $registrationData = array_fill(0, 12, 0);
        foreach ($registrationsByMonth as $item) {
            $registrationData[intval($item->month) - 1] = $item->total;
        }

        // Élèves par section (pour le graphique en camembert)
        $studentsBySection = Section::withCount('registrations')
            ->get()
            ->map(function ($section) {
                return [
                    'label' => $section->name,
                    'count' => $section->registrations_count
                ];
            });

        return view('pages.dashboard', compact(
            'schoolCount',
            'studentCount',
            'guardianCount',
            'classroomCount',
            'months',
            'registrationData',
            'studentsBySection'
        ));
    }
}
