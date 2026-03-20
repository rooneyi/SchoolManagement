@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Modifier l'élève</h1>
        <p class="text-zinc-500">Mettez à jour les informations de {{ $student->name }}.</p>
    </div>

    <div class="max-w-2xl rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-950">
        <form action="{{ route('students.update', $student) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-6 mb-6">
                @if($student->photo)
                    <img src="{{ Storage::url($student->photo) }}" alt="Photo" class="h-20 w-20 rounded-full object-cover border-2 border-zinc-100 dark:border-zinc-800 shadow-sm">
                @else
                    <div class="h-20 w-20 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-xl border-2 border-dashed border-blue-200 dark:bg-blue-900/20 dark:border-blue-800">
                        {{ substr($student->name, 0, 1) }}{{ substr($student->post_name, 0, 1) }}
                    </div>
                @endif
                <div class="flex-1" x-data="{ fileName: '' }">
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-800/50 border-zinc-300 dark:border-zinc-700 transition-colors group">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                            <svg class="w-8 h-8 mb-3 text-zinc-400 group-hover:text-blue-500 transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400" x-show="!fileName"><span class="font-bold text-blue-600 dark:text-blue-400">Cliquez pour modifier</span> ou glissez une image</p>
                            <p class="text-sm text-blue-600 font-semibold truncate max-w-[200px]" x-text="fileName" x-show="fileName"></p>
                            <p class="text-[10px] text-zinc-400 mt-1" x-show="!fileName">PNG, JPG (MAX. 1MB)</p>
                        </div>
                        <input id="photo" type="file" name="photo" class="hidden" accept="image/*" @change="fileName = $event.target.files[0].name" />
                    </label>
                    @error('photo') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="matricule" class="text-sm font-medium">Matricule</label>
                    <input type="text" name="matricule" id="matricule" value="{{ old('matricule', $student->matricule) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    @error('matricule') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="name" class="text-sm font-medium">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                    @error('name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="post_name" class="text-sm font-medium">Post-nom</label>
                    <input type="text" name="post_name" id="post_name" value="{{ old('post_name', $student->post_name) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                    @error('post_name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="birth_date" class="text-sm font-medium">Date de naissance</label>
                    <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $student->birth_date) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                    @error('birth_date') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                    @error('email') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="phone" class="text-sm font-medium">Téléphone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $student->phone) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                    @error('phone') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="address" class="text-sm font-medium">Adresse</label>
                <input type="text" name="address" id="address" value="{{ old('address', $student->address) }}" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800">
                @error('address') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="school_id" class="text-sm font-medium">École</label>
                    <select name="school_id" id="school_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                        <option value="">Sélectionnez une école</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}" {{ old('school_id', $student->school_id) == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                        @endforeach
                    </select>
                    @error('school_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="guardian_id" class="text-sm font-medium">Parent</label>
                    <select name="guardian_id" id="guardian_id" class="w-full rounded-md border border-zinc-200 bg-transparent px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-950 dark:border-zinc-800" required>
                        <option value="">Sélectionnez un parent</option>
                        @foreach($guardians as $guardian)
                            <option value="{{ $guardian->id }}" {{ old('guardian_id', $student->guardian_id) == $guardian->id ? 'selected' : '' }}>{{ $guardian->first_name }} {{ $guardian->last_name }}</option>
                        @endforeach
                    </select>
                    @error('guardian_id') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('students.index') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:hover:bg-zinc-900">Annuler</a>
                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
