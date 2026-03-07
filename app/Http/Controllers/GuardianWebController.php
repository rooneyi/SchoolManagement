<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardianRequest;
use App\Models\Guardian;
use App\Models\School;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GuardianWebController extends Controller
{
    public function index(): View
    {
        $guardians = Guardian::with('school')->get();

        return view('guardians.index', compact('guardians'));
    }

    public function create(): View
    {
        $schools = School::all();

        return view('guardians.create', compact('schools'));
    }

    public function store(GuardianRequest $request): RedirectResponse
    {
        $guardian = Guardian::create($request->validated());
        (new TelegramLogger)->log('Nouveau parent créé (web): '.$guardian->first_name.' '.$guardian->last_name);

        return redirect()->route('guardians.index')->with('success', 'Parent créé avec succès');
    }

    public function edit(Guardian $guardian): View
    {
        $schools = School::all();

        return view('guardians.edit', compact('guardian', 'schools'));
    }

    public function update(GuardianRequest $request, Guardian $guardian): RedirectResponse
    {
        $guardian->update($request->validated());
        (new TelegramLogger)->log('Parent mis à jour (web): '.$guardian->first_name.' '.$guardian->last_name);

        return redirect()->route('guardians.index')->with('success', 'Parent mis à jour avec succès');
    }

    public function destroy(Guardian $guardian): RedirectResponse
    {
        $name = $guardian->first_name.' '.$guardian->last_name;
        $guardian->delete();
        (new TelegramLogger)->log('Parent supprimé (web): '.$name);

        return redirect()->route('guardians.index')->with('success', 'Parent supprimé avec succès');
    }
}
