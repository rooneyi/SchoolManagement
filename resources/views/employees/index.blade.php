@extends('dashboard')

@section('content')
<div class="">
    <div class="mb-10 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-blue-950 dark:text-blue-400">Annuaire du personnel</h1>
            <p class="text-zinc-500 font-medium">Gestion des employés administratifs et enseignants.</p>
        </div>
        <a href="{{ route('employees.create') }}" class="inline-flex h-11 items-center justify-center rounded-xl bg-blue-900 px-6 py-2 text-sm font-bold text-white shadow-lg shadow-blue-900/20 transition-all hover:bg-blue-800 active:scale-[0.98]">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="mr-2"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
            Ajouter un employé
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
            <h3 class="font-bold text-blue-950 dark:text-white uppercase tracking-wider text-xs">Liste des employés</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                <tr class="text-zinc-500 uppercase text-[11px] font-bold tracking-widest border-b border-zinc-100 dark:border-zinc-800">
                    <th class="p-5">Employé</th>
                    <th class="p-5">Fonction</th>
                    <th class="p-5">Contacts</th>
                    <th class="p-5">Statut</th>
                    <th class="p-5">Entrée</th>
                    <th class="p-5 text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                @foreach($employees as $employee)
                    <tr class="group hover:bg-blue-50/30 transition-colors dark:hover:bg-blue-900/5">
                        <td class="p-5">
                            <div class="flex items-center gap-3">
                                @if($employee->photo_path)
                                    <img src="{{ Storage::url($employee->photo_path) }}" alt="{{ $employee->full_name }}" class="h-10 w-10 rounded-full object-cover border-2 border-white shadow-sm dark:border-zinc-800">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xs dark:bg-blue-900/30 dark:text-blue-400 border-2 border-white shadow-sm dark:border-zinc-800">
                                        {{ $employee->initials }}
                                    </div>
                                @endif
                                <div class="flex flex-col">
                                    <span class="font-bold text-blue-950 dark:text-white">{{ $employee->full_name }}</span>
                                    <span class="text-[10px] text-zinc-400 font-medium uppercase tracking-tighter">{{ $employee->email ?? '—' }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="p-5">
                            <span class="font-semibold text-zinc-700 dark:text-zinc-300 text-xs bg-zinc-100 px-2 py-1 rounded border border-zinc-200 dark:bg-zinc-800 dark:border-zinc-700">{{ $employee->job_title ?? 'Non défini' }}</span>
                        </td>
                        <td class="p-5">
                            <div class="flex flex-col gap-1 text-zinc-600 dark:text-zinc-400">
                                <span class="text-xs font-bold">{{ $employee->phone ?? '—' }}</span>
                                <span class="text-[10px] opacity-70 truncate max-w-[150px]">{{ $employee->address ?? '—' }}</span>
                            </div>
                        </td>
                        <td class="p-5">
                            @php
                                $statusColors = [
                                    'active' => 'bg-green-100 text-green-700 border-green-200',
                                    'inactive' => 'bg-zinc-100 text-zinc-600 border-zinc-200',
                                    'suspended' => 'bg-red-100 text-red-700 border-red-200',
                                ];
                                $label = match($employee->status) {
                                    'active' => 'Actif',
                                    'inactive' => 'Inactif',
                                    'suspended' => 'Suspendu',
                                    default => ucfirst($employee->status)
                                };
                            @endphp
                            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wide {{ $statusColors[$employee->status] ?? 'bg-zinc-100' }}">
                                {{ $label }}
                            </span>
                        </td>
                        <td class="p-5 text-sm text-zinc-500 font-mono text-xs">
                            {{ $employee->hiring_date ? $employee->hiring_date->format('d/m/Y') : '—' }}
                        </td>
                        <td class="p-5 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('employees.edit', $employee) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-blue-600 hover:bg-blue-100 transition-colors dark:hover:bg-blue-900/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                </a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression de cet employé ?')">
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
        <div class="p-4 border-t border-zinc-100">
            {{ $employees->links() }}
        </div>
    </div>
</div>
@endsection

