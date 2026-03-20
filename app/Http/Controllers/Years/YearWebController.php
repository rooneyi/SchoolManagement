<?php

namespace App\Http\Controllers\Years;

use App\Http\Controllers\Controller;
use App\Http\Requests\YearRequest;
use App\Models\School;
use App\Models\Year;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class YearWebController extends Controller
{
    public function index(): View
    {
        $years = Year::with('school')->get();

        return view('years.index', compact('years'));
    }

    public function create(): View
    {
        $schools = School::all();

        return view('years.create', compact('schools'));
    }

    public function store(YearRequest $request): RedirectResponse
    {
        $year = Year::create($request->validated());
        (new TelegramLogger)->log('Nouvelle année scolaire créée (web): '.$year->name);

        return redirect()->route('years.index')->with('success', 'Année scolaire créée avec succès');
    }

    public function edit(Year $year): View
    {
        $schools = School::all();

        return view('years.edit', compact('year', 'schools'));
    }

    public function update(YearRequest $request, Year $year): RedirectResponse
    {
        $year->update($request->validated());
        (new TelegramLogger)->log('Année scolaire mise à jour (web): '.$year->name);

        return redirect()->route('years.index')->with('success', 'Année scolaire mise à jour avec succès');
    }

    public function activate(Year $year): RedirectResponse
    {
        DB::transaction(function () use ($year) {
            if ($year->is_active) {
                // Si elle est déjà active, on la désactive simplement
                $year->update(['is_active' => false]);
                (new TelegramLogger)->log('Année scolaire désactivée (web): '.$year->name);
                $message = 'Année scolaire désactivée avec succès';
            } else {
                // Désactiver toutes les années de la même école avant d'activer celle-ci
                Year::where('school_id', $year->school_id)->update(['is_active' => false]);

                // Activer cette année
                $year->update(['is_active' => true]);
                (new TelegramLogger)->log('Année scolaire activée (web): '.$year->name);
                $message = 'Année scolaire activée avec succès';
            }
        });

        return redirect()->route('years.index')->with('success', $message ?? 'Opération réussie');
    }

    public function destroy(Year $year): RedirectResponse
    {
        $name = $year->name;
        $year->delete();
        (new TelegramLogger)->log('Année scolaire supprimée (web): '.$name);

        return redirect()->route('years.index')->with('success', 'Année scolaire supprimée avec succès');
    }
}
