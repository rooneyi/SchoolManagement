@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8 flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Modifier un employé</h1>
            <p class="text-zinc-500">Mettre à jour les informations du dossier.</p>
        </div>
        <form action="{{ route('employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('Confirmer la suppression de cet employé ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md border border-red-200 bg-red-50 px-4 py-2 text-sm font-medium text-red-600 transition-colors hover:bg-red-100 dark:border-red-900/30 dark:bg-red-900/10 dark:text-red-400">
                Supprimer
            </button>
        </form>
    </div>

    <div class="max-w-2xl rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('employees.update', $employee) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-6 mb-6">
                @if($employee->photo_path)
                    <img src="{{ Storage::url($employee->photo_path) }}" alt="Photo" class="h-20 w-20 rounded-full object-cover border-2 border-zinc-100 dark:border-zinc-800 shadow-sm">
                @else
                    <div class="h-20 w-20 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-xl border-2 border-dashed border-blue-200 dark:bg-blue-900/20 dark:border-blue-800">
                        {{ $employee->initials }}
                    </div>
                @endif
                <div class="flex-1 space-y-2" x-data="{ fileName: '' }">
                    <label for="photo" class="text-sm font-medium">Modifier la photo</label>
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-800/50 border-zinc-300 dark:border-zinc-700 transition-colors group">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                            <svg class="w-8 h-8 mb-3 text-zinc-400 group-hover:text-blue-500 transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400" x-show="!fileName"><span class="font-bold text-blue-600 dark:text-blue-400">Cliquez pour modifier</span> ou glissez une image</p>
                            <p class="text-sm text-blue-600 font-semibold truncate max-w-[200px]" x-text="fileName" x-show="fileName"></p>
                            <p class="text-[10px] text-zinc-400 mt-1" x-show="!fileName">PNG, JPG (MAX. 1MB)</p>
                        </div>
                        <input id="photo" type="file" name="photo" class="hidden" accept="image/*" @change="fileName = $event.target.files[0].name" />
                    </label>
                    @error('photo') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="first_name" class="text-sm font-medium">Prénom</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $employee->first_name) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    @error('first_name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="last_name" class="text-sm font-medium">Nom</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $employee->last_name) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    @error('last_name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="email" class="text-sm font-medium">Email professionnel</label>
                <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                @error('email') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="phone" class="text-sm font-medium">Téléphone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                    @error('phone') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="status" class="text-sm font-medium">Statut</label>
                    <select name="status" id="status" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                        <option value="active" {{ old('status', $employee->status) === 'active' ? 'selected' : '' }}>Actif</option>
                        <option value="inactive" {{ old('status', $employee->status) === 'inactive' ? 'selected' : '' }}>Inactif</option>
                        <option value="suspended" {{ old('status', $employee->status) === 'suspended' ? 'selected' : '' }}>Suspendu</option>
                    </select>
                    @error('status') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="job_title" class="text-sm font-medium">Fonction / Poste</label>
                    <input type="text" name="job_title" id="job_title" value="{{ old('job_title', $employee->job_title) }}" placeholder="Ex: Enseignant, Comptable..." class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                    @error('job_title') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="hiring_date" class="text-sm font-medium">Date d'embauche</label>
                    <input type="date" name="hiring_date" id="hiring_date" value="{{ old('hiring_date', $employee->hiring_date?->format('Y-m-d')) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                    @error('hiring_date') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="address" class="text-sm font-medium">Adresse</label>
                <textarea name="address" id="address" rows="2" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">{{ old('address', $employee->address) }}</textarea>
                @error('address') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="notes" class="text-sm font-medium">Notes (Interne)</label>
                <textarea name="notes" id="notes" rows="3" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">{{ old('notes', $employee->notes) }}</textarea>
                @error('notes') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="border-t border-zinc-100 pt-6 mt-6">
                @if($employee->user_id && $employee->user)
                    <div class="space-y-4 bg-blue-50/50 p-4 rounded-lg border border-blue-100 dark:bg-blue-900/10 dark:border-blue-900/20">
                        <div class="flex items-start gap-3">
                            <div class="mt-1 h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 dark:bg-blue-900 dark:text-blue-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-blue-900 dark:text-blue-300">Compte utilisateur actif</h4>
                                <p class="text-xs text-blue-700/80 dark:text-blue-400">Lié à : <span class="font-mono">{{ $employee->user->email }}</span></p>
                                <p class="text-xs text-blue-700/80 dark:text-blue-400">Rôle : <span class="uppercase font-bold tracking-wider text-[10px]">{{ $employee->user->role }}</span></p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mt-6" x-data="{ createUser: false }">
                        <div class="flex items-center gap-2 mb-4">
                            <input type="checkbox" name="create_user" id="create_user" value="1" class="rounded border-zinc-300 text-blue-600 shadow-sm focus:ring-blue-500" {{ old('create_user') ? 'checked' : '' }} x-model="createUser">
                            <label for="create_user" class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Créer un compte utilisateur pour cet employé</label>
                        </div>

                        <div x-show="createUser" x-transition class="space-y-4 bg-zinc-50 p-4 rounded-lg border border-zinc-200 dark:bg-zinc-900 dark:border-zinc-800">
                            <p class="text-xs text-zinc-500 mb-2">L'employé pourra se connecter avec son email ({{ $employee->email }} requis) et le mot de passe défini ci-dessous.</p>

                            <div class="space-y-2">
                                <label for="role" class="text-sm font-medium">Rôle sur la plateforme</label>
                                <select name="role" id="role" class="w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                                    <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>Enseignant</option>
                                    <option value="secretary" {{ old('role') === 'secretary' ? 'selected' : '' }}>Secrétaire</option>
                                    <option value="accountant" {{ old('role') === 'accountant' ? 'selected' : '' }}>Comptable</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrateur École</option>
                                </select>
                                @error('role') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="password" class="text-sm font-medium">Mot de passe</label>
                                    <input type="password" name="password" id="password" class="w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                                    @error('password') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="password_confirmation" class="text-sm font-medium">Confirmer le mot de passe</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="flex justify-end gap-4 pt-4 border-t border-zinc-100">
                <a href="{{ route('employees.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:hover:bg-zinc-900">Annuler</a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection

