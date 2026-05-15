@extends('layouts.app')

@section('title', 'Détails véhicule')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-6xl mx-auto w-full">
    <div class="bg-card text-card-foreground rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold mb-6 text-primary">Détails du véhicule</h1>

    @if ($vehicule->image)
        <img src="{{ route('image.serve', ['path' => $vehicule->image]) }}" alt="véhicule" class="w-64 h-48 object-cover rounded-lg shadow-md mb-6">
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Immatriculation :</strong> {{ $vehicule->immatriculation }}
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Marque :</strong> {{ $vehicule->marque }}
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Modèle :</strong> {{ $vehicule->modele }}
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Couleur :</strong> {{ $vehicule->couleur ?? '—' }}
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Année :</strong> {{ $vehicule->annee ?? '—' }}
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Kilométrage :</strong> {{ $vehicule->kilometrage ?? '—' }}
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Carrosserie :</strong> {{ $vehicule->carrosserie ?? '—' }}
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Énergie :</strong> {{ $vehicule->energie ?? '—' }}
        </div>
        <div class="bg-muted p-4 rounded-lg">
            <strong class="text-muted-foreground">Boîte :</strong> {{ $vehicule->boite ?? '—' }}
        </div>
    </div>

    <div class="flex flex-wrap gap-4 mb-8">
        <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="bg-primary hover:bg-primary-700 text-primary-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Modifier</a>
        <a href="{{ route('reparations.create', $vehicule->id) }}" class="bg-accent hover:bg-accent-700 text-accent-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Ajouter une réparation</a>
        <a href="{{ route('vehicules.index') }}" class="bg-muted hover:bg-muted-foreground/10 text-muted-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Retour à la liste</a>
    </div>

    <hr class="my-8 border-border">

    <h2 class="text-2xl font-bold mb-4 text-primary">Réparations du véhicule</h2>

    @if ($vehicule->reparations->isEmpty())
        <p class="text-muted-foreground">Aucune réparation enregistrée pour ce véhicule.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-card border border-border rounded-lg">
                <thead class="bg-muted">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-muted-foreground">Date début</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-muted-foreground">Date fin</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-muted-foreground">Description</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-muted-foreground">Technicien</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-muted-foreground">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicule->reparations as $reparation)
                        <tr class="border-t border-border hover:bg-muted/50 transition-colors">
                            <td class="px-4 py-3">{{ $reparation->date_debut }}</td>
                            <td class="px-4 py-3">{{ $reparation->date_fin ?? '—' }}</td>
                            <td class="px-4 py-3">{{ $reparation->description }}</td>
                            <td class="px-4 py-3">{{ $reparation->technicien->nom ?? 'Non assigné' }}</td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('reparations.edit', $reparation->id) }}" class="text-accent hover:text-accent-700 transition-colors">Modifier</a>
                                <form action="{{ route('reparations.destroy', $reparation->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Confirmer suppression ?')" class="text-red-600 hover:text-red-800 transition-colors">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    </div>
</div>
@endsection
