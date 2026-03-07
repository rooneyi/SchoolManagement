<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\Classroom;
use App\Models\Section;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClassroomWebController extends Controller
{
    public function index(): View
    {
        $classrooms = Classroom::with(['section.school'])->get();

        return view('classrooms.index', compact('classrooms'));
    }

    public function create(): View
    {
        $sections = Section::with('school')->get();

        return view('classrooms.create', compact('sections'));
    }

    public function store(StoreClassroomRequest $request): RedirectResponse
    {
        $classroom = Classroom::create($request->validated());
        (new TelegramLogger)->log('Nouvelle classe créée (web): '.$classroom->name);

        return redirect()->route('classrooms.index')->with('success', 'Classe créée avec succès');
    }

    public function edit(Classroom $classroom): View
    {
        $sections = Section::with('school')->get();

        return view('classrooms.edit', compact('classroom', 'sections'));
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom): RedirectResponse
    {
        $classroom->update($request->validated());
        (new TelegramLogger)->log('Classe mise à jour (web): '.$classroom->name);

        return redirect()->route('classrooms.index')->with('success', 'Classe mise à jour avec succès');
    }

    public function destroy(Classroom $classroom): RedirectResponse
    {
        $name = $classroom->name;
        $classroom->delete();
        (new TelegramLogger)->log('Classe supprimée (web): '.$name);

        return redirect()->route('classrooms.index')->with('success', 'Classe supprimée avec succès');
    }
}
