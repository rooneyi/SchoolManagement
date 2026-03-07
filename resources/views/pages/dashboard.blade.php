@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Tableau de bord</h1>
            <p class="text-zinc-500">Statistiques globales de l'école</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Dashboard Widgets -->
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <h3 class="text-sm font-medium text-zinc-500">Total Écoles</h3>
            <p class="text-2xl font-bold mt-2">{{ \App\Models\School::count() }}</p>
        </div>
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <h3 class="text-sm font-medium text-zinc-500">Total Élèves</h3>
            <p class="text-2xl font-bold mt-2">{{ \App\Models\Student::count() }}</p>
        </div>
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <h3 class="text-sm font-medium text-zinc-500">Total Parents</h3>
            <p class="text-2xl font-bold mt-2">{{ \App\Models\Guardian::count() }}</p>
        </div>
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <h3 class="text-sm font-medium text-zinc-500">Total Classes</h3>
            <p class="text-2xl font-bold mt-2">{{ \App\Models\Classroom::count() }}</p>
        </div>
    </div>
</div>
@endsection
