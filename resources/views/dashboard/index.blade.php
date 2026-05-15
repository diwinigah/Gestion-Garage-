@extends('layouts.app')

@section('title', 'Dashboard - Gestion Garage')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
    <div class="space-y-6">
        {{-- En-tête --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Dashboard</h1>
            <p class="text-muted-foreground">Bienvenue dans votre gestionnaire de garage</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="/" class="inline-flex items-center px-4 py-2 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/80 transition-colors text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Accueil
            </a>
            <a href="{{ route('vehicules.index') }}" class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Nouvelle réparation
            </a>
        </div>
    </div>

    {{-- Cartes statistiques --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-stat-card
            title="Véhicules"
            :value="\App\Models\Vehicule::count()"
            icon-path="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
            bg-color="bg-primary/10"
            icon-color="text-primary"
            :trend="5"
        />

        <x-stat-card
            title="Réparations"
            :value="\App\Models\Reparation::count()"
            icon-path="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
            bg-color="bg-accent/10"
            icon-color="text-accent"
            :trend="-2"
        />

        <x-stat-card
            title="Techniciens"
            :value="\App\Models\Technicien::count()"
            icon-path="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
            bg-color="bg-primary/10"
            icon-color="text-primary"
            :trend="0"
        />

        <x-stat-card
            title="En cours"
            :value="\App\Models\Reparation::where('statut', 'en_cours')->count()"
            icon-path="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"
            bg-color="bg-accent/10"
            icon-color="text-accent"
            :trend="8"
        />
    </div>

    {{-- Graphiques et contenu principal --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Graphique d'activité --}}
        <div class="lg:col-span-2 bg-card p-6 rounded-xl border border-border shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-foreground">Activité mensuelle</h2>
                <select class="px-3 py-1 text-sm border border-border rounded-lg bg-background text-foreground">
                    <option>Derniers 6 mois</option>
                    <option>Dernière année</option>
                </select>
            </div>
            <div class="h-64">
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        {{-- Interventions urgentes --}}
        <div class="bg-card p-6 rounded-xl border border-border shadow-sm">
            <h2 class="text-lg font-semibold text-foreground mb-4">Interventions urgentes</h2>
            <div class="space-y-3">
                @php
                    $urgentRepairs = \App\Models\Reparation::where('statut', 'en_cours')
                        ->orderBy('date_debut', 'asc')
                        ->take(5)
                        ->get();
                @endphp

                @forelse($urgentRepairs as $repair)
                    <div class="flex items-center justify-between p-3 bg-muted/50 rounded-lg">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-foreground">{{ Str::limit($repair->description, 30) }}</p>
                            <p class="text-xs text-muted-foreground">{{ $repair->date_debut ? \Carbon\Carbon::parse($repair->date_debut)->format('d/m/Y') : 'Date non définie' }}</p>
                        </div>
                        <x-status-badge status="urgent" />
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-muted-foreground/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="mt-2 text-sm text-muted-foreground">Aucune intervention urgente</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- RDV du jour --}}
    <div class="bg-card p-6 rounded-xl border border-border shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-foreground">Rendez-vous du jour</h2>
            <button class="text-sm text-primary hover:text-primary/80 font-medium">Voir calendrier</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @php
                $todayRepairs = \App\Models\Reparation::whereDate('date_debut', today())
                    ->with(['vehicule', 'technicien'])
                    ->get();
            @endphp

            @forelse($todayRepairs as $repair)
                <div class="p-4 border border-border rounded-lg hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-medium text-foreground">{{ $repair->vehicule->marque }} {{ $repair->vehicule->modele }}</h3>
                        <x-status-badge :status="$repair->statut" />
                    </div>
                    <p class="text-sm text-muted-foreground mb-2">{{ Str::limit($repair->description, 50) }}</p>
                    <div class="flex items-center text-xs text-muted-foreground">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ $repair->technicien->nom ?? 'Non assigné' }}
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-muted-foreground/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="mt-2 text-sm text-muted-foreground">Aucun rendez-vous prévu aujourd'hui</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

    {{-- Script pour le graphique --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('activityChart').getContext('2d');
            const activityChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                    datasets: [{
                        label: 'Réparations',
                        data: [12, 19, 3, 5, 2, 3],
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Véhicules',
                        data: [2, 3, 20, 5, 1, 4],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection