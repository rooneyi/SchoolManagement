<div class="flex min-h-screen">
    <aside class="relative hidden w-72 flex-col bg-blue-950 text-white lg:flex border-r border-blue-900 shadow-2xl overflow-hidden">
        {{-- Motif de fond subtil (identique au login) --}}
        <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900/20 via-transparent to-black/30 pointer-events-none"></div>

        <div class="relative z-20 flex h-full flex-col gap-6 p-6">
            <div class="flex items-center gap-3 px-2">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-blue-900 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-extrabold tracking-tighter leading-tight">Academia <span class="text-blue-400">CRM</span></span>
                    <span class="text-[10px] uppercase tracking-widest text-blue-300/60 font-bold">Portail Administration</span>
                </div>
            </div>

            <nav class="flex flex-1 flex-col gap-1.5 mt-4 overflow-y-auto custom-scrollbar">
                <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40 ring-1 ring-blue-500/50' : 'text-blue-100/70 hover:bg-blue-900/50 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="{{ request()->routeIs('dashboard') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                    Tableau de bord
                </a>

                <div class="mt-6 mb-2 px-4 text-[11px] font-bold uppercase tracking-[0.2em] text-blue-400/50">Administration</div>

                @if(auth()->user()?->isSystemAdmin())
                <a href="{{ route('schools.index') }}" class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('schools.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40 ring-1 ring-blue-500/50' : 'text-blue-100/70 hover:bg-blue-900/50 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="{{ request()->routeIs('schools.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"><path d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z"/></svg>
                    Écoles
                </a>
                @endif
                <a href="{{ route('years.index') }}" class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('years.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40 ring-1 ring-blue-500/50' : 'text-blue-100/70 hover:bg-blue-900/50 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="{{ request()->routeIs('years.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                    Années scolaires
                </a>

                <div class="mt-6 mb-2 px-4 text-[11px] font-bold uppercase tracking-[0.2em] text-blue-400/50">Pédagogie</div>

                <a href="{{ route('sections.index') }}" class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('sections.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40 ring-1 ring-blue-500/50' : 'text-blue-100/70 hover:bg-blue-900/50 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="{{ request()->routeIs('sections.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    Sections
                </a>
                <a href="{{ route('classrooms.index') }}" class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('classrooms.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40 ring-1 ring-blue-500/50' : 'text-blue-100/70 hover:bg-blue-900/50 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="{{ request()->routeIs('classrooms.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 3v18"/><path d="M3 9h18"/></svg>
                    Classes
                </a>
                <a href="{{ route('subjects.index') }}" class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('subjects.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40 ring-1 ring-blue-500/50' : 'text-blue-100/70 hover:bg-blue-900/50 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="{{ request()->routeIs('subjects.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M8 7h6"/><path d="M8 11h8"/></svg>
                    Matières
                </a>
                <a href="{{ route('teachings.index') }}" class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('teachings.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40 ring-1 ring-blue-500/50' : 'text-blue-100/70 hover:bg-blue-900/50 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="{{ request()->routeIs('teachings.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/><path d="m15 5 3 3"/></svg>
                    Assignation cours
                </a>
                <a href="{{ route('schedules.index') }}" class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('schedules.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40 ring-1 ring-blue-500/50' : 'text-blue-100/70 hover:bg-blue-900/50 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="{{ request()->routeIs('schedules.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Emploi du temps
                </a>

                <div class="mt-6 mb-2 px-4 text-[11px] font-bold uppercase tracking-[0.2em] text-blue-400/50">Personnes</div>

                <a href="{{ route('students.index') }}" class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('students.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40 ring-1 ring-blue-500/50' : 'text-blue-100/70 hover:bg-blue-900/50 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="{{ request()->routeIs('students.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Étudiants
                </a>
                <a href="{{ route('employees.index') }}" class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('employees.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40 ring-1 ring-blue-500/50' : 'text-blue-100/70 hover:bg-blue-900/50 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="{{ request()->routeIs('employees.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Personnel
                </a>

                <div class="mt-6 mb-2 px-4 text-[11px] font-bold uppercase tracking-[0.2em] text-blue-400/50">Comptabilité</div>

                <a href="{{ route('fees.index') }}" class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('fees.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40 ring-1 ring-blue-500/50' : 'text-blue-100/70 hover:bg-blue-900/50 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="{{ request()->routeIs('fees.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"><path d="M12 1v22"/><path d="M5 5h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H9a4 4 0 0 0-4 4 4 4 0 0 0 4 4h10"/></svg>
                    Comptabilité
                </a>
            </nav>

            <div class="mt-auto pt-6 border-t border-blue-900/50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="group flex w-full items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold text-red-400 transition-all duration-200 hover:bg-red-500/10 hover:text-red-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-70 group-hover:translate-x-0.5 transition-transform"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </aside>
</div>
