@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Gestion des inscriptions</h1>
            <p class="text-zinc-500">Suivi et gestion des inscriptions des élèves.</p>
        </div>
        <a href="{{ route('registrations.create') }}" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">
            + Nouvelle inscription
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-8 rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-950">
        <div class="p-6 text-sm">
            <h3 class="font-semibold leading-none tracking-tight">Liste des inscriptions récentes</h3>
        </div>
        <div class="border-t border-zinc-200 dark:border-zinc-800 overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                <tr class="border-b border-zinc-200 bg-zinc-50/50 dark:border-zinc-800 dark:bg-zinc-900/50">
                    <th class="p-4 text-left font-medium">Élève</th>
                    <th class="p-4 text-left font-medium">Classe / Section</th>
                    <th class="p-4 text-left font-medium">Année</th>
                    <th class="p-4 text-left font-medium">Date</th>
                    <th class="p-4 text-center font-medium">Statut</th>
                    <th class="p-4 text-right font-medium">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @foreach($registrations as $registration)
                    <tr>
                        <td class="p-4">
                            <div class="font-medium">{{ $registration->student->name }} {{ $registration->student->post_name }}</div>
                            <div class="text-xs text-zinc-500">Parent: {{ $registration->guardian->first_name }} {{ $registration->guardian->last_name }}</div>
                        </td>
                        <td class="p-4">
                            <div>{{ $registration->classroom?->name ?? 'Classe inconnue' }}</div>
                            <div class="text-xs text-zinc-500">{{ $registration->section?->name ?? 'Section inconnue' }}</div>
                        </td>
                        <td class="p-4">{{ $registration->year->name }}</td>
                        <td class="p-4">{{ $registration->registration_date }}</td>
                        <td class="p-4 text-center">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400',
                                    'confirmed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                    'canceled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                ];
                                $currentClass = $statusClasses[strtolower($registration->status)] ?? 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-400';
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $currentClass }}">
                                {{ ucfirst($registration->status) }}
                            </span>
                        </td>
                        <td class="p-4 text-right whitespace-nowrap space-x-2">
                            <div class="inline-flex items-center">
                                <form action="{{ route('registrations.status', $registration) }}" method="POST" class="inline-flex mr-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="text-xs rounded border-zinc-200 bg-zinc-50 p-1 dark:border-zinc-800 dark:bg-zinc-900">
                                        <option value="pending" {{ $registration->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmed" {{ $registration->status == 'confirmed' ? 'selected' : '' }}>Confirmé</option>
                                        <option value="canceled" {{ $registration->status == 'canceled' ? 'selected' : '' }}>Annulé</option>
                                    </select>
                                </form>
                                <a href="{{ route('registrations.edit', $registration) }}" class="text-blue-600 hover:underline text-xs">Modifier</a>
                                <form action="{{ route('registrations.destroy', $registration) }}" method="POST" class="inline ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-xs" onclick="return confirm('Supprimer cette inscription ?')">Supprimer</button>
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
