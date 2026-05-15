@extends('layouts.app')

@section('title', 'Véhicules - Gestion Garage')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-foreground">Véhicules</h1>
                <p class="text-muted-foreground">Gestion de la flotte automobile</p>
            </div>
        </div>

        {{-- Bouton ajouter --}}
        <div class="flex justify-end">
            <a href="{{ route('vehicules.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Ajouter un véhicule
            </a>
        </div>

        {{-- Barre de recherche --}}
        <div class="bg-card p-4 rounded-lg border border-border shadow-sm">
            <form method="GET" action="{{ route('vehicules.index') }}" class="flex gap-4">
                <div class="w-96">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par immatriculation..." class="w-full px-3 py-2 border border-border rounded-md bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
                </div>
                <button type="submit" class="px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                @if(request('search'))
                    <a href="{{ route('vehicules.index') }}" class="px-4 py-2 bg-muted text-muted-foreground rounded-md hover:bg-muted/80 transition-colors">Effacer</a>
                @endif
            </form>
        </div>

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Grille de cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($vehicules as $vehicule)
                <div class="bg-card rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-border">
                    {{-- Image --}}
                    <div class="aspect-video bg-muted relative overflow-hidden">
                        @if($vehicule->image)
                            <img src="{{ route('image.serve', ['path' => $vehicule->image]) }}" alt="{{ $vehicule->marque }} {{ $vehicule->modele }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Contenu --}}
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-semibold text-foreground">{{ $vehicule->marque }} {{ $vehicule->modele }}</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Disponible
                            </span>
                        </div>

                        <p class="text-sm text-muted-foreground mb-4">{{ $vehicule->immatriculation }}</p>

                        <div class="space-y-2 text-sm">
                            @if($vehicule->annee)
                                <div class="flex justify-between">
                                    <span class="text-muted-foreground">Année:</span>
                                    <span class="font-medium">{{ $vehicule->annee }}</span>
                                </div>
                            @endif
                            @if($vehicule->kilometrage)
                                <div class="flex justify-between">
                                    <span class="text-muted-foreground">Kilométrage:</span>
                                    <span class="font-medium">{{ number_format($vehicule->kilometrage) }} km</span>
                                </div>
                            @endif
                            @if($vehicule->couleur)
                                <div class="flex justify-between">
                                    <span class="text-muted-foreground">Couleur:</span>
                                    <span class="font-medium">{{ $vehicule->couleur }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-2 mt-6">
                            <a href="{{ route('vehicules.show', $vehicule->id) }}" class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-border rounded-lg text-sm font-medium text-foreground bg-background hover:bg-muted transition-colors">
                                Voir
                            </a>
                            <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-border rounded-lg text-sm font-medium text-foreground bg-background hover:bg-muted transition-colors">
                                Modifier
                            </a>
                            <form action="{{ route('vehicules.destroy', $vehicule->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 dark:border-red-600 dark:text-red-400 dark:bg-gray-800 dark:hover:bg-red-900 transition-colors">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-muted-foreground/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-foreground">Aucun véhicule trouvé</h3>
                    <p class="mt-2 text-muted-foreground">Il n'y a pas de véhicule correspondant à votre recherche.</p>
                    @if(request('search'))
                        <a href="{{ route('vehicules.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors">
                            Voir tous les véhicules
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($vehicules->hasPages())
            <div class="flex justify-center mt-8">
                {{ $vehicules->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
