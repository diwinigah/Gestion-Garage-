@extends('layouts.app')

@section('title', 'Détails de la réparation')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-4xl mx-auto w-full">
    <div class="bg-card text-card-foreground rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold mb-6 text-primary">Détails de la réparation</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Véhicule :</strong>
            <p class="mt-1">{{ $reparation->vehicule->immatriculation }} - {{ $reparation->vehicule->marque }} {{ $reparation->vehicule->modele }}</p>
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Technicien :</strong>
            <p class="mt-1">{{ $reparation->technicien ? $reparation->technicien->nom . ' ' . $reparation->technicien->prenom : 'Non assigné' }}</p>
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Date début :</strong>
            <p class="mt-1">{{ $reparation->date_debut ? \Carbon\Carbon::parse($reparation->date_debut)->format('d/m/Y') : '—' }}</p>
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Date fin :</strong>
            <p class="mt-1">{{ $reparation->date_fin ? \Carbon\Carbon::parse($reparation->date_fin)->format('d/m/Y') : '—' }}</p>
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Statut :</strong>
            <p class="mt-1">
                @if($reparation->statut == 'en_attente')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">En attente</span>
                @elseif($reparation->statut == 'en_cours')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">En cours</span>
                @elseif($reparation->statut == 'termine')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Terminé</span>
                @elseif($reparation->statut == 'urgent')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Urgent</span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">Annulé</span>
                @endif
            </p>
        </div>
    </div>

    <div class="bg-muted p-4 rounded-lg mb-6">
        <strong class="text-muted-foreground">Description :</strong>
        <p class="mt-1">{{ $reparation->description ?? 'Aucune description' }}</p>
    </div>

    <div class="flex flex-wrap gap-4">
        <a href="{{ route('reparations.edit', $reparation->id) }}" class="bg-primary hover:bg-primary/90 text-primary-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Modifier</a>
        <form method="POST" action="{{ route('reparations.destroy', $reparation->id) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réparation ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors">Supprimer</button>
        </form>
        <a href="{{ route('reparations.index') }}" class="bg-muted hover:bg-muted/80 text-muted-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Retour à la liste</a>
    </div>
    </div>
</div>
@endsection