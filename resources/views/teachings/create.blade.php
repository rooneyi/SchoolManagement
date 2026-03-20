@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Assignation des cours</h1>
        <p class="text-zinc-500">Attribuez les matières aux enseignants pour chaque classe.</p>
    </div>

    <div class="max-w-3xl rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('teachings.store') }}" method="POST" class="space-y-6" x-data="{
            selectedClassroomId: '{{ $selectedClassroom?->id ?? old('classroom_id') }}',
            isHigherEducation: {{ $selectedClassroom?->section->education_level === 'university' ? 'true' : 'false' }},

            checkLevel() {
                const select = document.getElementById('classroom_id');
                const selectedOption = select.options[select.selectedIndex];
                const level = selectedOption.getAttribute('data-level');
                this.isHigherEducation = (level === 'university');
            }
        }">
            @csrf

            <div class="space-y-2">
                <label for="classroom_id" class="text-sm font-medium">Classe</label>
                <select name="classroom_id" id="classroom_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required @change="checkLevel()">
                    <option value="">Sélectionnez une classe</option>
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" data-level="{{ $classroom->section->education_level }}" {{ (old('classroom_id') == $classroom->id || ($selectedClassroom?->id == $classroom->id)) ? 'selected' : '' }}>
                            {{ $classroom->name }} ({{ $classroom->section->education_level_label }})
                        </option>
                    @endforeach
                </select>
                @error('classroom_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="subject_id" class="text-sm font-medium">Matière</label>
                    <select name="subject_id" id="subject_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                        <option value="">Sélectionnez une matière</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }} {{ $subject->code ? "($subject->code)" : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="employee_id" class="text-sm font-medium">Enseignant</label>
                    <select name="employee_id" id="employee_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
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

            {{-- Champs spécifiques Supérieur --}}
            <div x-show="isHigherEducation" x-transition class="p-4 bg-zinc-50 rounded-lg border border-zinc-100 dark:bg-zinc-900/50 dark:border-zinc-800 space-y-4">
                <h4 class="text-sm font-bold text-zinc-700 dark:text-zinc-300">Paramètres spécifiques (Supérieur)</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="total_hours" class="text-sm font-medium">Volume horaire total</label>
                        <input type="number" name="total_hours" id="total_hours" value="{{ old('total_hours') }}" class="w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950" placeholder="Ex: 45 heures">
                        @error('total_hours') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="credits" class="text-sm font-medium">Crédits (ECTS/Autre)</label>
                        <input type="number" name="credits" id="credits" value="{{ old('credits') }}" class="w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950" placeholder="Ex: 3">
                        @error('credits') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4 border-t border-zinc-100">
                <a href="{{ route('teachings.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:hover:bg-zinc-900">Annuler</a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Assigner</button>
            </div>
        </form>
    </div>
</div>
@endsection

