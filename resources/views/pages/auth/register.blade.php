<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold tracking-tight text-blue-950 dark:text-blue-400">Créer un compte</h1>
            <p class="text-zinc-500">Rejoignez Academia CRM pour gérer votre établissement en toute simplicité.</p>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4">
            @csrf

            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Nom complet</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus placeholder="Jean Dupont" class="flex h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm transition-all focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 dark:border-zinc-800 dark:bg-zinc-950 dark:focus:border-blue-500">
                @error('name') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Adresse Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required placeholder="nom@exemple.com" class="flex h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm transition-all focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 dark:border-zinc-800 dark:bg-zinc-950 dark:focus:border-blue-500">
                @error('email') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="school_id" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">École</label>
                <select id="school_id" name="school_id" required class="flex h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm transition-all focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 dark:border-zinc-800 dark:bg-zinc-950 dark:focus:border-blue-500">
                    <option value="">Sélectionnez votre établissement</option>
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
                @error('school_id') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="password" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Mot de passe</label>
                    <input id="password" name="password" type="password" required placeholder="••••••••" class="flex h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm transition-all focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 dark:border-zinc-800 dark:bg-zinc-950 dark:focus:border-blue-500">
                    @error('password') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="password_confirmation" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Confirmation</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="••••••••" class="flex h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm transition-all focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 dark:border-zinc-800 dark:bg-zinc-950 dark:focus:border-blue-500">
                </div>
            </div>

            <button type="submit" class="mt-2 inline-flex h-11 items-center justify-center rounded-lg bg-blue-900 px-4 py-2 text-sm font-bold text-white shadow-lg transition-all hover:bg-blue-800 focus:ring-2 focus:ring-blue-900/50 active:scale-[0.98]">
                Créer mon compte
            </button>
        </form>

        <div class="text-center text-sm text-zinc-500">
            Vous avez déjà un compte ?
            <a href="{{ route('login') }}" class="font-bold text-blue-700 hover:text-blue-600 dark:text-blue-400">Se connecter</a>
        </div>
    </div>
</x-layouts::auth>
