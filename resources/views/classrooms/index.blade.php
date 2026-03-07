@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Gestion des classes</h1>
            <p class="text-zinc-500">Liste, création, modification et suppression des classes d'élèves.</p>
        </div>
        <a href="{{ route('classrooms.create') }}" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">
            + Ajouter une classe
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-8 rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-950">
        <div class="p-6">
            <h3 class="font-semibold leading-none tracking-tight">Liste des classes</h3>
        </div>
        <div class="border-t border-zinc-200 dark:border-zinc-800">
            <table class="w-full text-sm">
                <thead>
                <tr class="border-b border-zinc-200 bg-zinc-50/50 dark:border-zinc-800 dark:bg-zinc-900/50">
                    <th class="p-4 text-left font-medium">Nom</th>
                    <th class="p-4 text-left font-medium">Code</th>
                    <th class="p-4 text-left font-medium">Capacité</th>
                    <th class="p-4 text-left font-medium">Section</th>
                    <th class="p-4 text-left font-medium">École</th>
                    <th class="p-4 text-right font-medium">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @foreach($classrooms as $classroom)
                    <tr>
                        <td class="p-4">{{ $classroom->name }}</td>
                        <td class="p-4">{{ $classroom->code }}</td>
                        <td class="p-4">{{ $classroom->capacity }}</td>
                        <td class="p-4">{{ $classroom->section->name }}</td>
                        <td class="p-4">{{ $classroom->section->school->name }}</td>
                        <td class="p-4 text-right">
                            <a href="{{ route('classrooms.edit', $classroom) }}" class="text-blue-600 hover:underline">Modifier</a>
                            <form action="{{ route('classrooms.destroy', $classroom) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette classe ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
