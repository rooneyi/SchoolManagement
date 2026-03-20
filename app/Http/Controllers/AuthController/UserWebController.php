<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserWebController extends Controller
{
    public function create(): View
    {
        $schools = School::all();

        return view('create.student', compact('schools'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'school_id' => 'required|exists:schools,id',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('dashboard')->with('success', 'Utilisateur créé avec succès');
    }
}
