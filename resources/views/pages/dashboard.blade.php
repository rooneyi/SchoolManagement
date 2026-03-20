@extends('dashboard')

@section('content')
<div class="">
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold tracking-tight text-blue-950 dark:text-blue-400">Tableau de bord</h1>
        <p class="text-zinc-500 font-medium">Vue d'ensemble et statistiques de votre établissement.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Dashboard Widgets -->
        <div class="group rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-950">
            <div class="flex items-center justify-between mb-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z"/></svg>
                </div>
                <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full">+{{ $schoolCount }}</span>
            </div>
            <h3 class="text-sm font-bold text-zinc-500 uppercase tracking-wider">Écoles</h3>
            <p class="text-3xl font-extrabold mt-1 text-blue-950 dark:text-white">{{ $schoolCount }}</p>
        </div>

        <div class="group rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-950">
            <div class="flex items-center justify-between mb-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
            <h3 class="text-sm font-bold text-zinc-500 uppercase tracking-wider">Élèves</h3>
            <p class="text-3xl font-extrabold mt-1 text-blue-950 dark:text-white">{{ $studentCount }}</p>
        </div>

        <div class="group rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-950">
            <div class="flex items-center justify-between mb-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-900/20 dark:text-amber-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
            </div>
            <h3 class="text-sm font-bold text-zinc-500 uppercase tracking-wider">Parents</h3>
            <p class="text-3xl font-extrabold mt-1 text-blue-950 dark:text-white">{{ $guardianCount }}</p>
        </div>

        <div class="group rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition-all hover:shadow-md dark:border-zinc-800 dark:bg-zinc-950">
            <div class="flex items-center justify-between mb-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20 dark:text-emerald-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 3v18"/><path d="M3 9h18"/></svg>
                </div>
            </div>
            <h3 class="text-sm font-bold text-zinc-500 uppercase tracking-wider">Classes</h3>
            <p class="text-3xl font-extrabold mt-1 text-blue-950 dark:text-white">{{ $classroomCount }}</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="rounded-2xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-bold text-blue-950 dark:text-white">Inscriptions Mensuelles</h3>
                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Année en cours</span>
            </div>
            <div class="h-[300px] w-full">
                <canvas id="registrationsChart"></canvas>
            </div>
        </div>
        <div class="rounded-2xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-bold text-blue-950 dark:text-white">Répartition par Section</h3>
                <button class="text-xs font-bold text-zinc-400 hover:text-blue-600 transition-colors">Détails</button>
            </div>
            <div class="h-[300px] w-full flex justify-center">
                <canvas id="sectionsChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inscriptions Chart
        const regCtx = document.getElementById('registrationsChart').getContext('2d');
        const gradient = regCtx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(30, 58, 138, 0.2)');
        gradient.addColorStop(1, 'rgba(30, 58, 138, 0)');

        // Configuration globale pour le mode sombre
        const isDarkMode = document.documentElement.classList.contains('dark');
        const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
        const textColor = isDarkMode ? '#94a3b8' : '#64748b';

        new Chart(regCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Inscriptions',
                    data: {!! json_encode($registrationData) !!},
                    borderColor: '#1e3a8a',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#1e3a8a',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: isDarkMode ? '#18181b' : '#ffffff',
                        titleColor: isDarkMode ? '#fff' : '#0f172a',
                        bodyColor: isDarkMode ? '#fff' : '#0f172a',
                        borderColor: isDarkMode ? '#27272a' : '#e2e8f0',
                        borderWidth: 1,
                        padding: 10,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' Inscription(s)';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: gridColor,
                            drawBorder: false
                        },
                        ticks: {
                            font: { size: 11, family: "'Inter', sans-serif" },
                            color: textColor
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { size: 11, family: "'Inter', sans-serif" },
                            color: textColor
                        }
                    }
                }
            }
        });

        // Sections Chart
        const sectionsData = {!! json_encode($studentsBySection) !!};
        const secCtx = document.getElementById('sectionsChart').getContext('2d');

        // Palette de couleurs étendue (Bleus / Violets / Verts harmonieux)
        const palette = [
            '#1e3a8a', '#2563eb', '#60a5fa', '#93c5fd', '#bfdbfe', // Bleus
            '#4f46e5', '#818cf8', '#c084fc', // Indigos
            '#059669', '#34d399', '#6ee7b7'  // Emeraudes
        ];

        new Chart(secCtx, {
            type: 'doughnut',
            data: {
                labels: sectionsData.map(s => s.label),
                datasets: [{
                    data: sectionsData.map(s => s.count),
                    backgroundColor: palette,
                    borderWidth: 2,
                    borderColor: isDarkMode ? '#09090b' : '#ffffff',
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { size: 11, family: "'Inter', sans-serif" },
                            color: textColor
                        }
                    },
                    tooltip: {
                        backgroundColor: isDarkMode ? '#18181b' : '#ffffff',
                        titleColor: isDarkMode ? '#fff' : '#0f172a',
                        bodyColor: isDarkMode ? '#fff' : '#0f172a',
                        borderColor: isDarkMode ? '#27272a' : '#e2e8f0',
                        borderWidth: 1,
                    }
                },
                cutout: '70%',
                radius: '90%'
            }
        });
    });
</script>
@endsection
