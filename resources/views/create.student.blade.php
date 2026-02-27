@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Ajouter un élève</h1>
        <p class="text-zinc-500">Remplissez le formulaire pour créer un nouvel élève.</p>
    </div>
    <form action="{{ route('users.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-xl border border-zinc-200 shadow-sm dark:bg-zinc-950 dark:border-zinc-800">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium mb-1">Nom</label>
            <input type="text" name="name" id="name" class="w-full rounded border border-zinc-300 p-2" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" id="email" class="w-full rounded border border-zinc-300 p-2" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium mb-1">Mot de passe</label>
            <input type="password" name="password" id="password" class="w-full rounded border border-zinc-300 p-2" required>
        </div>
        <div class="mb-4">
            <label for="school_id" class="block text-sm font-medium mb-1">École</label>
            <select name="school_id" id="school_id" class="w-full rounded border border-zinc-300 p-2" required>
                @foreach($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Créer</button>
        </div>
    </form>
</div>
@endsection
