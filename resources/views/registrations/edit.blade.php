@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Modifier l'inscription</h1>
        <p class="text-zinc-500">Modifier les détails de l'inscription #{{ $registration->id }}.</p>
    </div>

    <div class="max-w-2xl rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('registrations.update', $registration) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="student_id" class="text-sm font-medium">Élève</label>
                    <select id="student_id" name="student_id" required class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $registration->student_id) == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} {{ $student->post_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="guardian_id" class="text-sm font-medium">Parent / Tuteur</label>
                    <select id="guardian_id" name="guardian_id" required class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                        @foreach($guardians as $guardian)
                            <option value="{{ $guardian->id }}" {{ old('guardian_id', $registration->guardian_id) == $guardian->id ? 'selected' : '' }}>
                                {{ $guardian->first_name }} {{ $guardian->last_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('guardian_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="school_id" class="text-sm font-medium">École</label>
                    <select id="school_id" name="school_id" required class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}" {{ old('school_id', $registration->school_id) == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                        @endforeach
                    </select>
                    @error('school_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="year_id" class="text-sm font-medium">Année Scolaire</label>
                    <select id="year_id" name="year_id" required class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                        @foreach($years as $year)
                            <option value="{{ $year->id }}" {{ old('year_id', $registration->year_id) == $year->id ? 'selected' : '' }}>
                                {{ $year->name }} {{ $year->is_active ? '(Active)' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('year_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="section_id" class="text-sm font-medium">Section</label>
                    <select id="section_id" name="section_id" required class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ old('section_id', $registration->section_id) == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                        @endforeach
                    </select>
                    @error('section_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="classroom_id" class="text-sm font-medium">Classe</label>
                    <select id="classroom_id" name="classroom_id" required class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ old('classroom_id', $registration->classroom_id) == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                    @error('classroom_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="registration_date" class="text-sm font-medium">Date d'inscription</label>
                    <input type="date" id="registration_date" name="registration_date" value="{{ old('registration_date', $registration->registration_date) }}" required class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                    @error('registration_date') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="status" class="text-sm font-medium">Statut</label>
                    <select id="status" name="status" required class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                        <option value="pending" {{ old('status', $registration->status) == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="confirmed" {{ old('status', $registration->status) == 'confirmed' ? 'selected' : '' }}>Confirmé</option>
                        <option value="canceled" {{ old('status', $registration->status) == 'canceled' ? 'selected' : '' }}>Annulé</option>
                    </select>
                    @error('status') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('registrations.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium hover:bg-zinc-100 dark:border-zinc-800 dark:bg-zinc-950 dark:hover:bg-zinc-900">
                    Annuler
                </a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
