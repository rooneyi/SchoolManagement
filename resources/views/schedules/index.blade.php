@extends('dashboard')

@section('content')
<div class="">
    <div class="mb-10 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-blue-950 dark:text-blue-400">Emploi du temps</h1>
            <p class="text-zinc-500 font-medium">Planning hebdomadaire des cours par classe.</p>
        </div>
        <a href="{{ route('schedules.create', ['classroom_id' => $selectedClassroom?->id]) }}" class="inline-flex h-11 items-center justify-center rounded-xl bg-blue-900 px-6 py-2 text-sm font-bold text-white shadow-lg shadow-blue-900/20 transition-all hover:bg-blue-800 active:scale-[0.98]">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="mr-2"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
            Ajouter un cours
        </a>
    </div>

    @if(session('success'))
        <div class="mb-8 flex items-center gap-3 rounded-2xl border border-green-100 bg-green-50 p-4 text-green-700 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        {{-- Sidebar Classes --}}
        <div class="lg:col-span-1 space-y-4">
            <div class="rounded-xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                <h3 class="font-bold text-blue-950 dark:text-white mb-4 text-sm">Sélectionner une classe</h3>
                <nav class="flex flex-col gap-1 max-h-[70vh] overflow-y-auto custom-scrollbar">
                    @foreach($classrooms as $classroom)
                        <a href="{{ route('schedules.index', ['classroom_id' => $classroom->id]) }}" class="flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ $selectedClassroom?->id == $classroom->id ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-900' }}">
                            <span>{{ $classroom->name }}</span>
                            <span class="inline-flex items-center justify-center rounded-full bg-zinc-100 px-2 text-[10px] text-zinc-500 dark:bg-zinc-800">{{ $classroom->section->code }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        </div>

        {{-- Calendrier --}}
        <div class="lg:col-span-3">
            <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/30 dark:bg-zinc-900/10">
                    <h3 class="font-bold text-blue-950 dark:text-white uppercase tracking-wider text-xs">
                        @if($selectedClassroom)
                            Planning : {{ $selectedClassroom->name }}
                        @else
                            Veuillez sélectionner une classe
                        @endif
                    </h3>
                </div>

                @if(!$selectedClassroom)
                    <div class="p-12 text-center text-zinc-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="mx-auto mb-4 text-zinc-300"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <p>Choisissez une classe dans la liste pour voir son emploi du temps.</p>
                    </div>
                @else
                    <div class="p-4 overflow-x-auto">
                        <div class="min-w-[800px]">
                            {{-- En-têtes Jours --}}
                            <div class="grid grid-cols-8 gap-4 mb-4">
                                <div class="col-span-1 text-xs font-bold text-zinc-400 text-center pt-2">Heure</div>
                                @foreach($days as $key => $day)
                                    <div class="col-span-1 text-center font-bold text-sm text-blue-900 dark:text-white uppercase tracking-wider">{{ substr($day, 0, 3) }}</div>
                                @endforeach
                            </div>

                            {{-- Grille horaire --}}
                            <div class="relative grid grid-cols-8 gap-4">
                                @foreach($timeSlots as $time)
                                    {{-- Colonne Heure --}}
                                    <div class="col-span-1 text-right text-xs font-mono text-zinc-400 -mt-2 pr-2 h-20 border-t border-zinc-100 dark:border-zinc-800">
                                        {{ $time }}
                                    </div>

                                    {{-- Colonnes Jours (Vides pour la structure) --}}
                                    @for($d = 1; $d <= 7; $d++)
                                        <div class="col-span-1 h-20 border-t border-dashed border-zinc-100 dark:border-zinc-800"></div>
                                    @endfor
                                @endforeach

                                {{-- Affichage des cours en position absolue --}}
                                @foreach($schedules as $course)
                                    @php
                                        // Calcul position
                                        // Start time: ex 08:00. Grid starts at 07:00.
                                        // Height calculation: (end - start) in hours * 80px (h-20)
                                        $start = \Carbon\Carbon::parse($course->start_time);
                                        $end = \Carbon\Carbon::parse($course->end_time);
                                        $duration = $start->diffInMinutes($end) / 60;
                                        $offset = $start->diffInMinutes(\Carbon\Carbon::parse('07:00')) / 60;

                                        $top = $offset * 80; // 5rem = 20 tailwind = 80px approx usually? No, h-20 is 5rem.
                                        $height = $duration * 80;

                                        // Grid col start: 1 (time) + day index
                                        $colStart = $course->day_of_week + 1;
                                    @endphp

                                    <div class="absolute inset-x-0 mx-1 p-2 rounded-lg shadow-sm border border-black/5 hover:scale-[1.02] transition-transform cursor-pointer group flex flex-col justify-between overflow-hidden"
                                         style="
                                            top: {{ $top }}px;
                                            height: {{ $height }}px;
                                            grid-column-start: {{ $colStart }};
                                            grid-column-end: span 1;
                                            background-color: {{ $course->subject->color }}20;
                                            border-left: 4px solid {{ $course->subject->color }};
                                         ">
                                        <div>
                                            <div class="font-bold text-xs text-blue-950 dark:text-white truncate">{{ $course->subject->name }}</div>
                                            <div class="text-[10px] font-medium text-zinc-600 dark:text-zinc-300 truncate">{{ $course->teacher ? $course->teacher->initials : '—' }} ({{ $course->room ?? 'N/A' }})</div>
                                        </div>
                                        <div class="flex justify-between items-end opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span class="text-[9px] font-mono text-zinc-500">{{ $start->format('H:i') }} - {{ $end->format('H:i') }}</span>
                                            <form action="{{ route('schedules.destroy', $course) }}" method="POST" onsubmit="return confirm('Supprimer ce cours ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 bg-white dark:bg-black rounded-full p-1 shadow-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

