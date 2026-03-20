@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Modifier la section</h1>
        <p class="text-zinc-500">Mettez à jour les informations de la section {{ $section->name }}.</p>
    </div>

    <div class="max-w-2xl rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('sections.update', $section) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="text-sm font-medium">Nom de la section</label>
                <input type="text" name="name" id="name" value="{{ old('name', $section->name) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                @error('name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="code" class="text-sm font-medium">Code de la section</label>
                <input type="text" name="code" id="code" value="{{ old('code', $section->code) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                @error('code') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="education_level" class="text-sm font-medium">Niveau d'enseignement</label>
                <select name="education_level" id="education_level" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    <option value="preschool" {{ old('education_level', $section->education_level) == 'preschool' ? 'selected' : '' }}>Maternelle</option>
                    <option value="primary" {{ old('education_level', $section->education_level) == 'primary' ? 'selected' : '' }}>Primaire</option>
                    <option value="secondary" {{ old('education_level', $section->education_level) == 'secondary' ? 'selected' : '' }}>Secondaire</option>
                    <option value="vocational" {{ old('education_level', $section->education_level) == 'vocational' ? 'selected' : '' }}>Professionnel</option>
                    <option value="university" {{ old('education_level', $section->education_level) == 'university' ? 'selected' : '' }}>Enseignement Supérieur / Université</option>
                </select>
                @error('education_level') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="school_id" class="text-sm font-medium">École</label>
                <select name="school_id" id="school_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    <option value="">Sélectionnez une école</option>
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}" {{ old('school_id', $section->school_id) == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                    @endforeach
                </select>
                @error('school_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('sections.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:hover:bg-zinc-900">Annuler</a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
