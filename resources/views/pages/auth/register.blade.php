<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-2 text-center">
            <h1 class="text-2xl font-bold tracking-tight">Créer un compte</h1>
            <p class="text-sm text-zinc-500">Rejoignez Academia CRM pour gérer votre école</p>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4">
            @csrf

            <div class="space-y-2">
                <label for="name" class="text-sm font-medium leading-none">Nom complet</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus placeholder="Jean Dupont" class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                @error('name') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="text-sm font-medium leading-none">Adresse Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required placeholder="nom@exemple.com" class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                @error('email') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="school_id" class="text-sm font-medium leading-none">École</label>
                <select id="school_id" name="school_id" required class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                    <option value="">Sélectionnez votre établissement</option>
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
                @error('school_id') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium leading-none">Mot de passe</label>
                    <input id="password" name="password" type="password" required placeholder="••••••••" class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                    @error('password') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="password_confirmation" class="text-sm font-medium leading-none">Confirmation</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="••••••••" class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950">
                </div>
            </div>

            <button type="submit" class="mt-2 inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 shadow transition-colors hover:bg-zinc-900/90 h-10 w-full dark:bg-zinc-50 dark:text-zinc-900">
                Créer mon compte
            </button>
        </form>

        <div class="text-center text-sm text-zinc-500">
            Vous avez déjà un compte ?
            <a href="{{ route('login') }}" class="font-medium text-zinc-900 underline-offset-4 hover:underline dark:text-zinc-50">Se connecter</a>
        </div>
    </div>
</x-layouts::auth>
