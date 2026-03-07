@extends('dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Tableau de bord</h1>
            <p class="text-zinc-500">Statistiques globales de l'école</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Dashboard Widgets -->
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <h3 class="text-sm font-medium text-zinc-500">Total Écoles</h3>
            <p class="text-2xl font-bold mt-2">{{ $schoolCount }}</p>
        </div>
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <h3 class="text-sm font-medium text-zinc-500">Total Élèves</h3>
            <p class="text-2xl font-bold mt-2">{{ $studentCount }}</p>
        </div>
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <h3 class="text-sm font-medium text-zinc-500">Total Parents</h3>
            <p class="text-2xl font-bold mt-2">{{ $guardianCount }}</p>
        </div>
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <h3 class="text-sm font-medium text-zinc-500">Total Classes</h3>
            <p class="text-2xl font-bold mt-2">{{ $classroomCount }}</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <h3 class="text-lg font-semibold mb-4">Inscriptions Mensuelles</h3>
            <div class="h-[300px] w-full">
                <canvas id="registrationsChart"></canvas>
            </div>
        </div>
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <h3 class="text-lg font-semibold mb-4">Répartition par Section</h3>
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
        new Chart(regCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Inscriptions',
                    data: {!! json_encode($registrationData) !!},
                    borderColor: '#18181b',
                    backgroundColor: 'rgba(24, 24, 27, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Sections Chart
        const sectionsData = {!! json_encode($studentsBySection) !!};
        const secCtx = document.getElementById('sectionsChart').getContext('2d');
        new Chart(secCtx, {
            type: 'doughnut',
            data: {
                labels: sectionsData.map(s => s.label),
                datasets: [{
                    data: sectionsData.map(s => s.count),
                    backgroundColor: [
                        '#18181b',
                        '#3f3f46',
                        '#71717a',
                        '#a1a1aa',
                        '#d4d4d8'
                    ],
                    borderWidth: 0
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
                            padding: 20
                        }
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endsection
