@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Modifier la classe</h1>
        <p class="text-zinc-500">Mettez à jour les informations de la classe {{ $classroom->name }}.</p>
    </div>

    <div class="max-w-2xl rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('classrooms.update', $classroom) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="text-sm font-medium">Nom de la classe</label>
                <input type="text" name="name" id="name" value="{{ old('name', $classroom->name) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                @error('name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="code" class="text-sm font-medium">Code de la classe</label>
                <input type="text" name="code" id="code" value="{{ old('code', $classroom->code) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                @error('code') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="capacity" class="text-sm font-medium">Capacité</label>
                <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $classroom->capacity) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required min="1">
                @error('capacity') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="section_id" class="text-sm font-medium">Section</label>
                <select name="section_id" id="section_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    <option value="">Sélectionnez une section</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ old('section_id', $classroom->section_id) == $section->id ? 'selected' : '' }}>{{ $section->name }} ({{ $section->school->name }})</option>
                    @endforeach
                </select>
                @error('section_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('classrooms.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:hover:bg-zinc-900">Annuler</a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
