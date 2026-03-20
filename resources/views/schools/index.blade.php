@extends('dashboard')

@section('content')
<div class="">
    <div class="mb-10 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-blue-950 dark:text-blue-400">Gestion des écoles</h1>
            <p class="text-zinc-500 font-medium">Liste, création, modification et suppression des établissements.</p>
        </div>
        <a href="{{ route('schools.create') }}" class="inline-flex h-11 items-center justify-center rounded-xl bg-blue-900 px-6 py-2 text-sm font-bold text-white shadow-lg shadow-blue-900/20 transition-all hover:bg-blue-800 active:scale-[0.98]">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Ajouter une école
        </a>
    </div>

    @if(session('success'))
        <div class="mb-8 flex items-center gap-3 rounded-2xl border border-green-100 bg-green-50 p-4 text-green-700 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
        <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
            <h3 class="font-bold text-blue-950 dark:text-white uppercase tracking-wider text-xs">Liste des écoles enregistrées</h3>
            <span class="text-[10px] font-bold text-zinc-400">{{ $schools->count() }} Établissement(s)</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                <tr class="bg-zinc-50/50 dark:bg-zinc-900/50 text-zinc-500 uppercase text-[11px] font-bold tracking-widest">
                    <th class="p-5 border-b border-zinc-100 dark:border-zinc-800">Nom de l'école</th>
                    <th class="p-5 border-b border-zinc-100 dark:border-zinc-800">Localisation</th>
                    <th class="p-5 border-b border-zinc-100 dark:border-zinc-800">Contact Téléphonique</th>
                    <th class="p-5 border-b border-zinc-100 dark:border-zinc-800">Adresse Email</th>
                    <th class="p-5 border-b border-zinc-100 dark:border-zinc-800 text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                @foreach($schools as $school)
                    <tr class="group hover:bg-blue-50/30 transition-colors dark:hover:bg-blue-900/5">
                        <td class="p-5">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-lg bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xs dark:bg-blue-900/30 dark:text-blue-400">
                                    {{ substr($school->name, 0, 1) }}
                                </div>
                                <span class="font-bold text-blue-950 dark:text-white">{{ $school->name }}</span>
                            </div>
                        </td>
                        <td class="p-5 text-zinc-600 dark:text-zinc-400 font-medium">{{ $school->address }}</td>
                        <td class="p-5 text-zinc-600 dark:text-zinc-400 font-medium italic">{{ $school->phone }}</td>
                        <td class="p-5">
                            <span class="inline-flex items-center rounded-lg bg-zinc-100 px-2.5 py-1 text-xs font-bold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400 italic">
                                {{ $school->email }}
                            </span>
                        </td>
                        <td class="p-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('schools.edit', $school) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-blue-600 hover:bg-blue-100 transition-colors dark:hover:bg-blue-900/30" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                </a>
                                <form action="{{ route('schools.destroy', $school) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette école ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-red-500 hover:bg-red-50 transition-colors dark:hover:bg-red-900/20" title="Supprimer">
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
