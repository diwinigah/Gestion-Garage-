@extends('layouts.app')

@section('title', 'Réparations - Gestion Garage')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
    <div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-foreground">Réparations</h1>
        <p class="text-muted-foreground">Gestion des interventions et réparations</p>
    </div>

    {{-- Message de succès --}}
    @if(session('success'))
        <x-toast :show="true" type="success" title="Succès" :message="session('success')" />
    @endif

    {{-- Barre de recherche --}}
    <div class="bg-card p-4 rounded-lg border border-border shadow-sm">
        <form method="GET" action="{{ route('reparations.index') }}" class="flex gap-4">
            <div class="w-96">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par immatriculation, marque, modèle, description ou statut..." class="w-full px-3 py-2 border border-border rounded-md bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>
            <button type="submit" class="px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
            @if(request('search'))
                <a href="{{ route('reparations.index') }}" class="px-4 py-2 bg-muted text-muted-foreground rounded-md hover:bg-muted/80 transition-colors">Effacer</a>
            @endif
        </form>
    </div>

    {{-- Bouton ajouter --}}
    <div class="flex justify-end">
        <a href="{{ route('vehicules.index') }}" class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors text-sm font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Nouvelle réparation
        </a>
    </div>

    {{-- Grille de cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($reparations as $reparation)
            <div class="bg-card rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-border">
                {{-- Image du véhicule --}}
                <div class="aspect-video bg-muted relative overflow-hidden">
                    @if($reparation->vehicule->image)
                        <img src="{{ route('image.serve', ['path' => $reparation->vehicule->image]) }}" alt="{{ $reparation->vehicule->marque }} {{ $reparation->vehicule->modele }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Contenu --}}
                <div class="p-4">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-base font-semibold text-foreground">{{ $reparation->vehicule->marque }} {{ $reparation->vehicule->modele }}</h3>
                        {{-- Badge statut --}}
                        @if($reparation->statut == 'en_attente')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">En attente</span>
                        @elseif($reparation->statut == 'en_cours')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">En cours</span>
                        @elseif($reparation->statut == 'termine')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Terminé</span>
                        @elseif($reparation->statut == 'urgent')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Urgent</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">Annulé</span>
                        @endif
                    </div>

                    <p class="text-sm text-muted-foreground mb-3">{{ $reparation->vehicule->immatriculation }}</p>

                    <div class="space-y-1 text-sm">
                        @if($reparation->date_debut)
                            <div class="flex justify-between">
                                <span class="text-muted-foreground">Début:</span>
                                <span class="font-medium">{{ \Carbon\Carbon::parse($reparation->date_debut)->format('d/m/Y') }}</span>
                            </div>
                        @endif
                        @if($reparation->date_fin)
                            <div class="flex justify-between">
                                <span class="text-muted-foreground">Fin:</span>
                                <span class="font-medium">{{ \Carbon\Carbon::parse($reparation->date_fin)->format('d/m/Y') }}</span>
                            </div>
                        @endif
                        @if($reparation->technicien)
                            <div class="flex justify-between">
                                <span class="text-muted-foreground">Technicien:</span>
                                <span class="font-medium">{{ $reparation->technicien->prenom }} {{ $reparation->technicien->nom }}</span>
                            </div>
                        @endif
                    </div>

                    @if($reparation->description)
                        <p class="text-sm text-muted-foreground mt-2 line-clamp-2">{{ Str::limit($reparation->description, 80) }}</p>
                    @endif

                    {{-- Actions --}}
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('reparations.show', $reparation->id) }}" class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-border rounded-lg text-sm font-medium text-foreground bg-background hover:bg-muted transition-colors">
                            Voir
                        </a>
                        <a href="{{ route('reparations.edit', $reparation->id) }}" class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-border rounded-lg text-sm font-medium text-foreground bg-background hover:bg-muted transition-colors">
                            Modifier
                        </a>
                        <button onclick="confirmDelete({{ $reparation->id }})" class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 dark:border-red-600 dark:text-red-400 dark:bg-red-900/20 dark:hover:bg-red-900/40 transition-colors">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="mx-auto h-24 w-24 text-muted-foreground/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-foreground">Aucune réparation trouvée</h3>
                <p class="mt-2 text-muted-foreground">Il n'y a pas de réparation correspondant à votre recherche.</p>
                @if(request('search'))
                    <a href="{{ route('reparations.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors">
                        Voir toutes les réparations
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($reparations->hasPages())
        <div class="flex justify-center mt-8">
            {{ $reparations->links() }}
        </div>
    @endif
</div>

<script>
function confirmDelete(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette réparation ?')) {
        // Créer un formulaire temporaire et le soumettre
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/reparations/${id}`;

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';

        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';

        form.appendChild(csrf);
        form.appendChild(method);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection