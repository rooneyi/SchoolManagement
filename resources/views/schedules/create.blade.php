@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Ajouter un créneau horaire</h1>
        <p class="text-zinc-500">Planifiez un cours pour une classe donnée.</p>
    </div>

    <div class="max-w-2xl rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('schedules.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="classroom_id" class="text-sm font-medium">Classe</label>
                <select name="classroom_id" id="classroom_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    <option value="">Sélectionnez une classe</option>
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ (old('classroom_id') == $classroom->id || ($selectedClassroom?->id == $classroom->id)) ? 'selected' : '' }}>
                            {{ $classroom->name }} ({{ $classroom->section->education_level_label }})
                        </option>
                    @endforeach
                </select>
                @error('classroom_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="subject_id" class="text-sm font-medium">Matière</label>
                    <select name="subject_id" id="subject_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                        <option value="">Sélectionnez une matière</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="employee_id" class="text-sm font-medium">Enseignant (Optionnel)</label>
                    <select name="employee_id" id="employee_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                        <option value="">Sélectionnez un enseignant</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('employee_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->full_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="space-y-2">
                    <label for="day_of_week" class="text-sm font-medium">Jour</label>
                    <select name="day_of_week" id="day_of_week" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                        <option value="1" {{ old('day_of_week') == 1 ? 'selected' : '' }}>Lundi</option>
                        <option value="2" {{ old('day_of_week') == 2 ? 'selected' : '' }}>Mardi</option>
                        <option value="3" {{ old('day_of_week') == 3 ? 'selected' : '' }}>Mercredi</option>
                        <option value="4" {{ old('day_of_week') == 4 ? 'selected' : '' }}>Jeudi</option>
                        <option value="5" {{ old('day_of_week') == 5 ? 'selected' : '' }}>Vendredi</option>
                        <option value="6" {{ old('day_of_week') == 6 ? 'selected' : '' }}>Samedi</option>
                        <option value="7" {{ old('day_of_week') == 7 ? 'selected' : '' }}>Dimanche</option>
                    </select>
                    @error('day_of_week') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="start_time" class="text-sm font-medium">Heure début</label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time', '08:00') }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    @error('start_time') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="end_time" class="text-sm font-medium">Heure fin</label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time', '09:00') }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    @error('end_time') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="room" class="text-sm font-medium">Salle (Optionnel)</label>
                <input type="text" name="room" id="room" value="{{ old('room') }}" placeholder="Ex: Salle 101, Labo" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                @error('room') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-4 pt-4 border-t border-zinc-100">
                <a href="{{ route('schedules.index', ['classroom_id' => $selectedClassroom?->id]) }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:hover:bg-zinc-900">Annuler</a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Ajouter au planning</button>
            </div>
        </form>
    </div>
</div>
@endsection

