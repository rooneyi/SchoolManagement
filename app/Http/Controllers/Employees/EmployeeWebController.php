<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use App\Services\TelegramLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class EmployeeWebController extends Controller
{
    public function index(): View
    {
        $employees = Employee::latest()->with('user')->paginate(20);

        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        return view('employees.create');
    }

    public function store(EmployeeRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Gérer l'upload de photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('employees', 'public');
            $data['photo_path'] = $path;
        }

        // Créer l'employé d'abord (pour récupérer l'id si besoin, mais ici user est optionnel)
        // Si on crée un user, on doit récupérer son ID pour le lier à l'employé.

        $user = null;
        if ($request->boolean('create_user')) {
             if (empty($data['email'])) {
                 throw ValidationException::withMessages(['email' => 'L\'email est requis pour créer un compte utilisateur.']);
             }

             // Check if email already exists in users
             if (User::where('email', $data['email'])->exists()) {
                 throw ValidationException::withMessages(['email' => 'Cet email est déjà lié à un compte utilisateur.']);
             }

             $user = User::create([
                 'name' => $data['first_name'] . ' ' . $data['last_name'],
                 'email' => $data['email'],
                 'password' => Hash::make($request->input('password', 'password')), // Default password if empty? Or required? Validation says nullable but confirmed.
                 'role' => $request->input('role', 'user'),
                 'school_id' => auth()->user()->school_id, // L'admin donne accès à SON école
             ]);

             $data['user_id'] = $user->id;
        }

        $employee = Employee::create($data);

        (new TelegramLogger)->log('Nouvel employé ajouté (web): '.$employee->getFullNameAttribute() . ($user ? ' avec accès utilisateur' : ''));

        return redirect()->route('employees.index')->with('success', 'Employé ajouté avec succès.');
    }

    public function edit(Employee $employee): View
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('employees', 'public');
            $data['photo_path'] = $path;
        }

        // Gestion de la création de compte user a posteriori
        if ($request->boolean('create_user') && !$employee->user_id) {
             if (empty($data['email'])) {
                 throw ValidationException::withMessages(['email' => 'L\'email est requis pour créer un compte utilisateur.']);
             }

             if (User::where('email', $data['email'])->exists()) {
                 throw ValidationException::withMessages(['email' => 'Cet email est déjà lié à un compte utilisateur.']);
             }

             $user = User::create([
                 'name' => $data['first_name'] . ' ' . $data['last_name'],
                 'email' => $data['email'],
                 'password' => Hash::make($request->input('password', 'password')),
                 'role' => $request->input('role', 'user'),
                 'school_id' => auth()->user()->school_id,
             ]);

             $data['user_id'] = $user->id;
        }

        $employee->update($data);

        (new TelegramLogger)->log('Employé mis à jour (web): #'.$employee->id);

        return redirect()->route('employees.index')->with('success', 'Fiche employé mise à jour.');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();
        (new TelegramLogger)->log('Employé supprimé (web): #'.$employee->id);

        return redirect()->route('employees.index')->with('success', 'Employé supprimé.');
    }
}

