@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Modifier le parent</h1>
        <p class="text-zinc-500">Mettez à jour les informations de {{ $guardian->first_name }} {{ $guardian->last_name }}.</p>
    </div>

    <div class="max-w-2xl rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('guardians.update', $guardian) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="first_name" class="text-sm font-medium">Prénom</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $guardian->first_name) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    @error('first_name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="last_name" class="text-sm font-medium">Nom</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $guardian->last_name) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    @error('last_name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="email" class="text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $guardian->email) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                @error('email') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="phone" class="text-sm font-medium">Téléphone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $guardian->phone) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                @error('phone') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="address" class="text-sm font-medium">Adresse</label>
                <input type="text" name="address" id="address" value="{{ old('address', $guardian->address) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                @error('address') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="school_id" class="text-sm font-medium">École</label>
                <select name="school_id" id="school_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    <option value="">Sélectionnez une école</option>
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}" {{ old('school_id', $guardian->school_id) == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                    @endforeach
                </select>
                @error('school_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('guardians.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:hover:bg-zinc-900">Annuler</a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
