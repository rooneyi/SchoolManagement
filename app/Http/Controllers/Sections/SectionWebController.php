<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\School;
use App\Models\Section;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SectionWebController extends Controller
{
    public function index(): View
    {
        $sections = Section::with('school')->get();

        return view('sections.index', compact('sections'));
    }

    public function create(): View
    {
        $schools = School::all();

        return view('sections.create', compact('schools'));
    }

    public function store(StoreSectionRequest $request): RedirectResponse
    {
        $section = Section::create($request->validated());
        (new TelegramLogger)->log('Nouvelle section créée (web): '.$section->name);

        return redirect()->route('sections.index')->with('success', 'Section créée avec succès');
    }

    public function edit(Section $section): View
    {
        $schools = School::all();

        return view('sections.edit', compact('section', 'schools'));
    }

    public function update(UpdateSectionRequest $request, Section $section): RedirectResponse
    {
        $section->update($request->validated());
        (new TelegramLogger)->log('Section mise à jour (web): '.$section->name);

        return redirect()->route('sections.index')->with('success', 'Section mise à jour avec succès');
    }

    public function destroy(Section $section): RedirectResponse
    {
        $name = $section->name;
        $section->delete();
        (new TelegramLogger)->log('Section supprimée (web): '.$name);

        return redirect()->route('sections.index')->with('success', 'Section supprimée avec succès');
    }
}
