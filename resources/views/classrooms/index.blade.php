@extends('dashboard')

@section('content')
<div class="">
    <div class="mb-10 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-blue-950 dark:text-blue-400">Gestion des classes</h1>
            <p class="text-zinc-500 font-medium">Administration des salles et groupes d'élèves par section.</p>
        </div>
        <a href="{{ route('classrooms.create') }}" class="inline-flex h-11 items-center justify-center rounded-xl bg-blue-900 px-6 py-2 text-sm font-bold text-white shadow-lg shadow-blue-900/20 transition-all hover:bg-blue-800 active:scale-[0.98]">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Nouvelle classe
        </a>
    </div>

    @if(session('success'))
        <div class="mb-8 flex items-center gap-3 rounded-2xl border border-green-100 bg-green-50 p-4 text-green-700 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
        <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/30 dark:bg-zinc-900/10">
            <h3 class="font-bold text-blue-950 dark:text-white uppercase tracking-wider text-xs">Salles de classe</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                <tr class="text-zinc-500 uppercase text-[11px] font-bold tracking-widest border-b border-zinc-100 dark:border-zinc-800">
                    <th class="p-5">Classe</th>
                    <th class="p-5">Code</th>
                    <th class="p-5 text-center">Capacité</th>
                    <th class="p-5">Section</th>
                    <th class="p-5">École Affiliée</th>
                    <th class="p-5 text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                @foreach($classrooms as $classroom)
                    <tr class="group hover:bg-blue-50/30 transition-colors dark:hover:bg-blue-900/5">
                        <td class="p-5">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 3v18"/><path d="M3 9h18"/></svg>
                                </div>
                                <span class="font-bold text-blue-950 dark:text-white">{{ $classroom->name }}</span>
                            </div>
                        </td>
                        <td class="p-5 font-mono text-[11px] font-bold text-zinc-400 tracking-tighter">{{ $classroom->code }}</td>
                        <td class="p-5 text-center">
                            <span class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-extrabold text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                {{ $classroom->capacity }} places
                            </span>
                        </td>
                        <td class="p-5">
                            <span class="text-zinc-600 dark:text-zinc-400 font-bold text-xs uppercase">{{ $classroom->section?->name ?? 'Section inconnue' }}</span>
                        </td>
                        <td class="p-5 text-zinc-400 text-[10px] font-medium uppercase tracking-widest">
                            {{ $classroom->section?->school?->name ?? 'École inconnue' }}
                        </td>
                        <td class="p-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('classrooms.edit', $classroom) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-blue-600 hover:bg-blue-100 transition-colors dark:hover:bg-blue-900/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                </a>
                                <form action="{{ route('classrooms.destroy', $classroom) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cette classe ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-red-500 hover:bg-red-50 transition-colors dark:hover:bg-red-900/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
