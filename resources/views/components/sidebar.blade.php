<div class="flex min-h-screen">
    <aside class="hidden w-64 border-r border-zinc-200 bg-zinc-50/50 lg:block dark:border-zinc-800 dark:bg-zinc-900/50">
        <div class="flex h-full flex-col gap-4 p-6">
            <div class="flex items-center gap-2 font-bold tracking-tight">
                <div class="flex h-8 w-8 items-center justify-center rounded bg-black text-white dark:bg-white dark:text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
                <span>Academia CRM</span>
            </div>

            <nav class="flex flex-1 flex-col gap-1 mt-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-50' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-70"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                    Tableau de bord
                </a>

                <div class="mt-4 mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-zinc-400">Administration</div>

                <a href="{{ route('schools.index') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('schools.*') ? 'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-50' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-70"><path d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z"/></svg>
                    Écoles
                </a>
                <a href="{{ route('years.index') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('years.*') ? 'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-50' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-70"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                    Années scolaires
                </a>

                <div class="mt-4 mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-zinc-400">Pédagogie</div>

                <a href="{{ route('sections.index') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('sections.*') ? 'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-50' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-70"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    Sections
                </a>
                <a href="{{ route('classrooms.index') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('classrooms.*') ? 'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-50' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-70"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 3v18"/><path d="M3 9h18"/></svg>
                    Classes
                </a>

                <div class="mt-4 mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-zinc-400">Personnes</div>

                <a href="{{ route('students.index') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('students.*') ? 'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-50' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-70"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Étudiants
                </a>
                <a href="{{ route('guardians.index') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('guardians.*') ? 'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-50' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-70"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Parents
                </a>

                <div class="mt-auto pt-8">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-70"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </aside>
</div>
