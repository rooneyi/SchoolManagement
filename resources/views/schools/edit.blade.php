@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Modifier une école</h1>
        <p class="text-zinc-500">Modifiez les informations de l'école.</p>
    </div>
    <form action="{{ route('schools.update', $school) }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-xl border border-zinc-200 shadow-sm dark:bg-zinc-950 dark:border-zinc-800">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium mb-1">Nom</label>
            <input type="text" name="name" id="name" value="{{ $school->name }}" class="w-full rounded border border-zinc-300 p-2" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium mb-1">Adresse</label>
            <input type="text" name="address" id="address" value="{{ $school->address }}" class="w-full rounded border border-zinc-300 p-2" required>
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium mb-1">Téléphone</label>
            <input type="text" name="phone" id="phone" value="{{ $school->phone }}" class="w-full rounded border border-zinc-300 p-2" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ $school->email }}" class="w-full rounded border border-zinc-300 p-2" required>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
