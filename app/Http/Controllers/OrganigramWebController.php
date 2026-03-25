<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\School;
use App\Models\Employee;
use App\Models\SchoolBibliography;

class OrganigramWebController extends Controller
{
    public function show(School $school)
    {
        // Fetch all employees for the school, grouped by job_title
        $personnels = Employee::where('school_id', $school->id)
            ->orderBy('job_title')
            ->orderBy('last_name')
            ->get();

        // Fetch all bibliographies for the school
        $bibliographies = SchoolBibliography::where('school_id', $school->id)
            ->orderByDesc('year')
            ->get();

        return view('organigram.show', [
            'school' => $school,
            'personnels' => $personnels,
            'bibliographies' => $bibliographies,
        ]);
    }
}
