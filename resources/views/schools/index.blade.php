@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Gestion des écoles</h1>
            <p class="text-zinc-500">Liste, création, modification et suppression des écoles.</p>
        </div>
        <a href="{{ route('schools.create') }}" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">">
            + Ajouter une école
        </a>
    </div>

    <div class="mt-8 rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-950">
        <div class="p-6">
            <h3 class="font-semibold leading-none tracking-tight">Liste des écoles</h3>
        </div>
        <div class="border-t border-zinc-200 dark:border-zinc-800">
            <table class="w-full text-sm">
                <thead>
                <tr class="border-b border-zinc-200 bg-zinc-50/50 dark:border-zinc-800 dark:bg-zinc-900/50">
                    <th class="p-4 text-left font-medium">Nom</th>
                    <th class="p-4 text-left font-medium">Adresse</th>
                    <th class="p-4 text-left font-medium">Téléphone</th>
                    <th class="p-4 text-left font-medium">Email</th>
                    <th class="p-4 text-right font-medium">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @foreach($schools as $school)
                    <tr>
                        <td class="p-4">{{ $school->name }}</td>
                        <td class="p-4">{{ $school->address }}</td>
                        <td class="p-4">{{ $school->phone }}</td>
                        <td class="p-4">{{ $school->email }}</td>
                        <td class="p-4 text-right">
                            <a href="{{ route('schools.edit', $school) }}" class="text-blue-600 hover:underline">Modifier</a>
                            <form action="{{ route('schools.destroy', $school) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">Supprimer</button>
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
