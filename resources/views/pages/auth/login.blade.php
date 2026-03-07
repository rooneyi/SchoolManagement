<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-2 text-center">
            <h1 class="text-2xl font-bold tracking-tight">Academia CRM</h1>
            <p class="text-sm text-zinc-500">Connectez-vous pour gérer votre établissement</p>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <div class="space-y-2">
                <label for="email" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Adresse Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="nom@exemple.com" class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-950 dark:placeholder:text-zinc-400 dark:focus-visible:ring-zinc-300">
                @error('email') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label for="password" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Mot de passe</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-zinc-900 underline-offset-4 hover:underline dark:text-zinc-50">Mot de passe oublié ?</a>
                    @endif
                </div>
                <input id="password" name="password" type="password" required autocomplete="current-password" placeholder="••••••••" class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-950 dark:placeholder:text-zinc-400 dark:focus-visible:ring-zinc-300">
                @error('password') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center space-x-2">
                <input type="checkbox" id="remember" name="remember" class="h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-950">
                <label for="remember" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Se souvenir de moi</label>
            </div>

            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 shadow transition-colors hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-zinc-50 dark:text-zinc-900 dark:hover:bg-zinc-50/90 dark:focus-visible:ring-zinc-300 h-10 w-full">
                Se connecter
            </button>
        </form>

        @if (Route::has('register'))
            <div class="text-center text-sm text-zinc-500">
                Vous n'avez pas de compte ?
                <a href="{{ route('register') }}" class="font-medium text-zinc-900 underline-offset-4 hover:underline dark:text-zinc-50">S'inscrire</a>
            </div>
        @endif
    </div>
</x-layouts::auth>
