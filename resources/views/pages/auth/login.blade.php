<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold tracking-tight text-blue-950 dark:text-blue-400">Connexion</h1>
            <p class="text-zinc-500">Heureux de vous revoir ! Veuillez entrer vos identifiants.</p>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Adresse Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="nom@exemple.com" class="flex h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white transition-all focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 dark:border-zinc-800 dark:bg-zinc-950 dark:focus:border-blue-500">
                @error('email') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label for="password" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Mot de passe</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-medium text-blue-700 hover:text-blue-600 dark:text-blue-400">Mot de passe oublié ?</a>
                    @endif
                </div>
                <input id="password" name="password" type="password" required autocomplete="current-password" placeholder="••••••••" class="flex h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white transition-all focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 dark:border-zinc-800 dark:bg-zinc-950 dark:focus:border-blue-500">
                @error('password') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center space-x-2">
                <input type="checkbox" id="remember" name="remember" class="h-4 w-4 rounded border-zinc-300 text-blue-700 focus:ring-blue-600">
                <label for="remember" class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Se souvenir de moi</label>
            </div>

            <button type="submit" class="inline-flex h-11 items-center justify-center rounded-lg bg-blue-900 px-4 py-2 text-sm font-bold text-white shadow-lg transition-all hover:bg-blue-800 focus:ring-2 focus:ring-blue-900/50 active:scale-[0.98]">
                Se connecter
            </button>
        </form>

        @if (Route::has('register'))
            <div class="text-center text-sm text-zinc-500">
                Vous n'avez pas de compte ?
                <a href="{{ route('register') }}" class="font-bold text-blue-700 hover:text-blue-600 dark:text-blue-400">S'inscrire</a>
            </div>
        @endif
    </div>
</x-layouts::auth>
