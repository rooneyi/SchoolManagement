@extends('dashboard')

@section('content')
<div class="">
    <div class="mb-10 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-blue-950 dark:text-blue-400">Charge d'enseignement</h1>
            <p class="text-zinc-500 font-medium">Répartition des cours et des enseignants par classe.</p>
        </div>
        <a href="{{ route('teachings.create', ['classroom_id' => request('classroom_id')]) }}" class="inline-flex h-11 items-center justify-center rounded-xl bg-blue-900 px-6 py-2 text-sm font-bold text-white shadow-lg shadow-blue-900/20 transition-all hover:bg-blue-800 active:scale-[0.98]">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="mr-2"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
            Assigner un cours
        </a>
    </div>

    @if(session('success'))
        <div class="mb-8 flex items-center gap-3 rounded-2xl border border-green-100 bg-green-50 p-4 text-green-700 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1 space-y-4">
            <div class="rounded-xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                <h3 class="font-bold text-blue-950 dark:text-white mb-4 text-sm">Filtrer par classe</h3>
                <nav class="flex flex-col gap-1 max-h-[70vh] overflow-y-auto custom-scrollbar">
                    <a href="{{ route('teachings.index') }}" class="flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ !request('classroom_id') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-900' }}">
                        <span>Toutes les classes</span>
                    </a>
                    @foreach($classrooms as $classroom)
                        <a href="{{ route('teachings.index', ['classroom_id' => $classroom->id]) }}" class="flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ request('classroom_id') == $classroom->id ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-900' }}">
                            <span>{{ $classroom->name }}</span>
                            <span class="inline-flex items-center justify-center rounded-full bg-zinc-100 px-2 text-[10px] text-zinc-500 dark:bg-zinc-800">{{ $classroom->section->education_level_label }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        </div>

        <div class="lg:col-span-3">
            <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/30 dark:bg-zinc-900/10">
                    <h3 class="font-bold text-blue-950 dark:text-white uppercase tracking-wider text-xs">
                        @if($selectedClassroom)
                            Cours de {{ $selectedClassroom->name }}
                        @else
                            Tous les enseignements
                        @endif
                    </h3>
                </div>

                @if($teachings->isEmpty())
                    <div class="p-12 text-center">
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-zinc-100 text-zinc-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M8 7h6"/><path d="M8 11h8"/></svg>
                        </div>
                        <h3 class="text-sm font-semibold text-zinc-900">Aucun cours assigné</h3>
                        <p class="text-sm text-zinc-500 mt-1">Sélectionnez une classe ou commencez par assigner un cours.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                            <tr class="text-zinc-500 uppercase text-[11px] font-bold tracking-widest border-b border-zinc-100 dark:border-zinc-800">
                                @if(!$selectedClassroom) <th class="p-5">Classe</th> @endif
                                <th class="p-5">Matière</th>
                                <th class="p-5">Enseignant</th>
                                <th class="p-5">Détails</th>
                                <th class="p-5 text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                            @foreach($teachings as $teaching)
                                <tr class="group hover:bg-blue-50/30 transition-colors dark:hover:bg-blue-900/5">
                                    @if(!$selectedClassroom)
                                        <td class="p-5 font-medium text-zinc-900 dark:text-zinc-100">{{ $teaching->classroom->name }}</td>
                                    @endif
                                    <td class="p-5">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-1 rounded-full" style="background-color: {{ $teaching->subject->color }}"></div>
                                            <span class="font-bold text-blue-950 dark:text-white">{{ $teaching->subject->name }}</span>
                                        </div>
                                    </td>
                                    <td class="p-5">
                                        <div class="flex items-center gap-2">
                                            @if($teaching->teacher && $teaching->teacher->photo_path)
                                                <img src="{{ Storage::url($teaching->teacher->photo_path) }}" class="h-6 w-6 rounded-full object-cover">
                                            @else
                                                <div class="h-6 w-6 rounded-full bg-zinc-100 flex items-center justify-center text-[10px] font-bold text-zinc-500">
                                                    {{ $teaching->teacher ? $teaching->teacher->initials : '?' }}
                                                </div>
                                            @endif
                                            <span class="text-zinc-700 dark:text-zinc-300">{{ $teaching->teacher ? $teaching->teacher->full_name : 'Non assigné' }}</span>
                                        </div>
                                    </td>
                                    <td class="p-5">
                                        @if($teaching->classroom->section->education_level === 'university')
                                            <div class="flex flex-col gap-1">
                                                <span class="text-xs text-zinc-500">Vol: {{ $teaching->total_hours ?? '-' }}h</span>
                                                <span class="text-xs text-zinc-500">Crédits: {{ $teaching->credits ?? '-' }}</span>
                                            </div>
                                        @else
                                            <span class="text-xs text-zinc-400 italic">Standard</span>
                                        @endif
                                    </td>
                                    <td class="p-5 text-right whitespace-nowrap">
                                        <form action="{{ route('teachings.destroy', $teaching) }}" method="POST" class="inline" onsubmit="return confirm('Retirer cette assignation ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-red-500 hover:bg-red-50 transition-colors dark:hover:bg-red-900/20" title="Retirer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-zinc-100">
                        {{ $teachings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

