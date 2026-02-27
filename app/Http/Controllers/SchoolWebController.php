<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Http\Requests\SchoolRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\TelegramLogger;


class SchoolWebController extends Controller
{
    public function index(): View
    {
        $schools = School::all();
        return view('schools.index', compact('schools'));
    }

    public function create(): View
    {
        return view('schools.create');
    }

    public function store(SchoolRequest $request): RedirectResponse
    {
        $school = School::create($request->validated());
        (new TelegramLogger())->log('Nouvelle école créée (web): ' . $school->name);
        return redirect()->route('schools.index')->with('success', 'École créée avec succès');
    }

    public function edit(School $school): View
    {
        return view('schools.edit', compact('school'));
    }

    public function update(SchoolRequest $request, School $school): RedirectResponse
    {
        $school->update($request->validated());
        (new TelegramLogger())->log('École mise à jour (web): ' . $school->name);
        return redirect()->route('schools.index')->with('success', 'École mise à jour avec succès');
    }

    public function destroy(School $school): RedirectResponse
    {
        $name = $school->name;
        $school->delete();
        (new TelegramLogger())->log('École supprimée (web): ' . $name);
        return redirect()->route('schools.index')->with('success', 'École supprimée avec succès');
    }
}