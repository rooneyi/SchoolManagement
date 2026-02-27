<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-1 text-center">
            <h1 class="text-2xl font-semibold tracking-tight">
                {{ __('Créer un compte') }}
            </h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">
                {{ __('Entrez vos informations pour rejoindre l\'académie') }}
            </p>
        </div>

        <x-auth-session-status class="text-center text-sm font-medium text-green-600" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="grid gap-5">
            @csrf

            <flux:input
                name="name"
                :label="__('Nom complet')"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                placeholder="Ex: Jean Dupont"
                class="bg-white dark:bg-zinc-950"
            />

            <flux:input
                name="email"
                :label="__('Adresse email')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="nom@ecole.com"
                class="bg-white dark:bg-zinc-950"
            />

            <flux:select name="school_id" :label="__('École')" required class="bg-white dark:bg-zinc-950">
                @foreach($schools as $school)
                    <flux:select.option :value="$school->id">{{ $school->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                <flux:input
                    name="password"
                    :label="__('Mot de passe')"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    viewable
                    class="bg-white dark:bg-zinc-950"
                />

                <flux:input
                    name="password_confirmation"
                    :label="__('Confirmation')"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    viewable
                    class="bg-white dark:bg-zinc-950"
                />
            </div>

            <div class="mt-2">
                <flux:button type="submit" variant="primary" class="w-full bg-zinc-900 text-zinc-50 hover:bg-zinc-800 dark:bg-zinc-50 dark:text-zinc-900 dark:hover:bg-zinc-200 border-none h-10 shadow-sm" data-test="register-user-button">
                    {{ __('Créer mon compte') }}
                </flux:button>
            </div>
        </form>

        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <span class="w-full border-t border-zinc-200 dark:border-zinc-800"></span>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-white px-2 text-zinc-500 dark:bg-zinc-950">Ou</span>
            </div>
        </div>

        <div class="text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('Vous avez déjà un compte ?') }}
            <flux:link :href="route('login')" wire:navigate class="font-medium text-zinc-900 underline underline-offset-4 hover:text-zinc-700 dark:text-zinc-50 dark:hover:text-zinc-300">
                {{ __('Se connecter') }}
            </flux:link>
        </div>
    </div>
</x-layouts::auth>
