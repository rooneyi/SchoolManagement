<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(): View
    {
        $students = User::where('role', 'user')->count();
        $teachers = User::where('role', 'teacher')->count();
        $absences = 0; // À remplacer par la vraie stat si table absences
        return view('dashboard', compact('students', 'teachers', 'absences'));
    }
}