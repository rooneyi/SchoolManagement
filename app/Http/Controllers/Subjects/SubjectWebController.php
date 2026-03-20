<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SubjectWebController extends Controller
{
    public function index(): View
    {
        $subjects = Subject::latest()->get();

        return view('subjects.index', compact('subjects'));
    }

    public function create(): View
    {
        return view('subjects.create');
    }

    public function store(SubjectRequest $request): RedirectResponse
    {
        $subject = Subject::create($request->validated());

        (new TelegramLogger)->log('Nouvelle matière ajoutée (web): '.$subject->name);

        return redirect()->route('subjects.index')->with('success', 'Matière ajoutée avec succès.');
    }

    public function edit(Subject $subject): View
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(SubjectRequest $request, Subject $subject): RedirectResponse
    {
        $subject->update($request->validated());

        (new TelegramLogger)->log('Matière mise à jour (web): '.$subject->name);

        return redirect()->route('subjects.index')->with('success', 'Matière mise à jour.');
    }

    public function destroy(Subject $subject): RedirectResponse
    {
        $subject->delete();
        (new TelegramLogger)->log('Matière supprimée (web): '.$subject->name);

        return redirect()->route('subjects.index')->with('success', 'Matière supprimée.');
    }
}

