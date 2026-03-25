@php /** @var \App\Models\School $school */ @endphp
@extends('layouts.app.sidebar')

@section('content')
<div class="min-h-screen bg-blue-950/90 py-10 px-4 md:px-10">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-extrabold text-white tracking-tight mb-8 drop-shadow">Organigramme de l'école : <span class="text-blue-300">{{ $school->name }}</span></h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($personnels->groupBy('role') as $role => $group)
                <div class="bg-white/90 dark:bg-zinc-900/90 rounded-2xl shadow-2xl border border-blue-900/20 flex flex-col">
                    <div class="px-6 py-4 border-b border-blue-100 dark:border-zinc-800 bg-blue-900/90 rounded-t-2xl">
                        <h2 class="text-lg font-bold text-white tracking-wide uppercase flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-300"><circle cx="9" cy="9" r="8"/></svg>
                            {{ __(ucfirst($role)) }}
                        </h2>
                    </div>
                    <div class="flex flex-col gap-3 p-4">
                        @foreach($group as $person)
                            <div class="rounded-xl bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-900 px-4 py-3 shadow-sm">
                                <div class="font-semibold text-blue-900 dark:text-blue-200">{{ $person->name }}</div>
                                <div class="text-xs text-blue-700 dark:text-blue-300/70">{{ $person->email }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-14">
            <h2 class="text-2xl font-bold text-blue-200 mb-6 tracking-wide flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-400"><rect x="3" y="3" width="14" height="14" rx="3"/></svg>
                Bibliographie de l'école
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($bibliographies as $biblio)
                    <div class="rounded-xl bg-white/90 dark:bg-zinc-900/90 border border-blue-100 dark:border-blue-900 p-5 shadow-lg">
                        <div class="font-bold text-blue-900 dark:text-blue-200 text-lg mb-1">{{ $biblio->title }}</div>
                        <div class="text-xs text-blue-700 dark:text-blue-300/70 mb-2">{{ $biblio->author }} ({{ $biblio->year }}) - {{ $biblio->type }}</div>
                        <div class="text-sm text-zinc-700 dark:text-zinc-300 mb-2">{{ $biblio->description }}</div>
                        @if($biblio->url)
                            <a href="{{ $biblio->url }}" class="text-blue-600 underline text-xs" target="_blank">Lien</a>
                        @endif
                    </div>
                @empty
                    <div class="text-blue-100 italic">Aucune ressource enregistrée pour cette école.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
