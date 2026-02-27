<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Manager | Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
<div class="flex min-h-screen">
    @include('components.sidebar')
    <main class="flex-1 flex flex-col">
        <header class="flex h-16 items-center justify-between border-b border-zinc-200 px-8 dark:border-zinc-800">
            <div class="flex items-center gap-4">
                <h2 class="text-sm font-semibold uppercase tracking-wider text-zinc-500">Vue d'ensemble</h2>
            </div>
            <div class="flex items-center gap-4">
                <button class="rounded-full bg-zinc-100 p-2 hover:bg-zinc-200 dark:bg-zinc-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                </button>
                <div class="h-8 w-8 rounded-full bg-zinc-300 dark:bg-zinc-700"></div>
            </div>
        </header>
        <div class="p-8">
            <div class="mb-8 flex items-end justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Bonjour, Admin</h1>
                    <p class="text-zinc-500">Voici ce qui se passe dans votre école aujourd'hui.</p>
                </div>
                <button class="inline-flex h-10 items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-50 transition-colors hover:bg-zinc-900/90 dark:bg-zinc-50 dark:text-zinc-900">
                    + Ajouter un élève
                </button>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                    <div class="flex flex-row items-center justify-between pb-2">
                        <h3 class="text-sm font-medium tracking-tight">Total Élèves</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-zinc-500"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div class="text-2xl font-bold">1,284</div>
                    <p class="text-xs text-zinc-500">+12% depuis le mois dernier</p>
                </div>
                <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                    <div class="flex flex-row items-center justify-between pb-2">
                        <h3 class="text-sm font-medium tracking-tight">Enseignants</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-zinc-500"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <div class="text-2xl font-bold">42</div>
                    <p class="text-xs text-zinc-500">3 nouveaux cette semaine</p>
                </div>
                <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                    <div class="flex flex-row items-center justify-between pb-2">
                        <h3 class="text-sm font-medium tracking-tight">Taux de Présence</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-zinc-500"><path d="M12 20v-6M6 20V10M18 20V4"/></svg>
                    </div>
                    <div class="text-2xl font-bold">94.2%</div>
                    <p class="text-xs text-zinc-500">Stable par rapport à hier</p>
                </div>
            </div>
            <div class="mt-8 rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-950">
                <div class="p-6">
                    <h3 class="font-semibold leading-none tracking-tight">Inscriptions Récentes</h3>
                    <p class="text-sm text-zinc-500 mt-2">Derniers élèves ajoutés au système.</p>
                </div>
                <div class="border-t border-zinc-200 dark:border-zinc-800">
                    <table class="w-full text-sm">
                        <thead>
                        <tr class="border-b border-zinc-200 bg-zinc-50/50 dark:border-zinc-800 dark:bg-zinc-900/50">
                            <th class="p-4 text-left font-medium">Nom</th>
                            <th class="p-4 text-left font-medium">Classe</th>
                            <th class="p-4 text-left font-medium">Date</th>
                            <th class="p-4 text-right font-medium">Statut</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        <tr>
                            <td class="p-4">Jean Dupont</td>
                            <td class="p-4">Terminale S</td>
                            <td class="p-4 text-zinc-500">24 Fév 2026</td>
                            <td class="p-4 text-right"><span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Actif</span></td>
                        </tr>
                        <tr>
                            <td class="p-4">Marie Curie</td>
                            <td class="p-4">Seconde A</td>
                            <td class="p-4 text-zinc-500">23 Fév 2026</td>
                            <td class="p-4 text-right"><span class="inline-flex items-center rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-medium text-zinc-800">En attente</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
                        <h3 class="text-sm font-medium tracking-tight">Total Élèves</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-zinc-500"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div class="text-2xl font-bold">1,284</div>
                    <p class="text-xs text-zinc-500">+12% depuis le mois dernier</p>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                    <div class="flex flex-row items-center justify-between pb-2">
                        <h3 class="text-sm font-medium tracking-tight">Enseignants</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-zinc-500"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <div class="text-2xl font-bold">42</div>
                    <p class="text-xs text-zinc-500">3 nouveaux cette semaine</p>
                </div>

                <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                    <div class="flex flex-row items-center justify-between pb-2">
                        <h3 class="text-sm font-medium tracking-tight">Taux de Présence</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-zinc-500"><path d="M12 20v-6M6 20V10M18 20V4"/></svg>
                    </div>
                    <div class="text-2xl font-bold">94.2%</div>
                    <p class="text-xs text-zinc-500">Stable par rapport à hier</p>
                </div>
            </div>

            <div class="mt-8 rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-950">
                <div class="p-6">
                    <h3 class="font-semibold leading-none tracking-tight">Inscriptions Récentes</h3>
                    <p class="text-sm text-zinc-500 mt-2">Derniers élèves ajoutés au système.</p>
                </div>
                <div class="border-t border-zinc-200 dark:border-zinc-800">
                    <table class="w-full text-sm">
                        <thead>
                        <tr class="border-b border-zinc-200 bg-zinc-50/50 dark:border-zinc-800 dark:bg-zinc-900/50">
                            <th class="p-4 text-left font-medium">Nom</th>
                            <th class="p-4 text-left font-medium">Classe</th>
                            <th class="p-4 text-left font-medium">Date</th>
                            <th class="p-4 text-right font-medium">Statut</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        <tr>
                            <td class="p-4">Jean Dupont</td>
                            <td class="p-4">Terminale S</td>
                            <td class="p-4 text-zinc-500">24 Fév 2026</td>
                            <td class="p-4 text-right"><span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Actif</span></td>
                        </tr>
                        <tr>
                            <td class="p-4">Marie Curie</td>
                            <td class="p-4">Seconde A</td>
                            <td class="p-4 text-zinc-500">23 Fév 2026</td>
                            <td class="p-4 text-right"><span class="inline-flex items-center rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-medium text-zinc-800">En attente</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>


</body>
</html>
