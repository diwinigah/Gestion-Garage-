@extends('layouts.app')

@section('title', 'Modifier une réparation')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-2xl mx-auto w-full">
    <div class="bg-card text-card-foreground rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold mb-6 text-primary">Modifier une réparation</h1>

    @if ($errors->any())
        <ul class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <p class="mb-6 p-4 bg-muted rounded-lg"><strong class="text-muted-foreground">Véhicule :</strong> {{ $reparation->vehicule->immatriculation }} – {{ $reparation->vehicule->marque }} {{ $reparation->vehicule->modele }}</p>

    <form method="POST" action="{{ route('reparations.update', $reparation->id) }}" class="space-y-6">
        @csrf
        @method('PUT')
        <input type="hidden" name="vehicule_id" value="{{ $reparation->vehicule_id }}">

        <div>
            <label for="date_debut" class="block text-sm font-medium text-foreground">Date début *</label>
            <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut', $reparation->date_debut) }}" required class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
        </div>

        <div>
            <label for="date_fin" class="block text-sm font-medium text-foreground">Date fin</label>
            <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin', $reparation->date_fin) }}" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-foreground">Description *</label>
            <textarea name="description" id="description" required rows="4" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">{{ old('description', $reparation->description) }}</textarea>
        </div>

        <div>
            <label for="technicien_id" class="block text-sm font-medium text-foreground">Technicien</label>
            <select name="technicien_id" id="technicien_id" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
                <option value="">— Non assigné —</option>
                @foreach ($techniciens as $technicien)
                    <option value="{{ $technicien->id }}" {{ old('technicien_id', $reparation->technicien_id) == $technicien->id ? 'selected' : '' }}>
                        {{ $technicien->nom }} {{ $technicien->prenom }} ({{ $technicien->specialite }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="statut" class="block text-sm font-medium text-foreground">Statut</label>
            <select name="statut" id="statut" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
                <option value="en_attente" {{ old('statut', $reparation->statut) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="en_cours" {{ old('statut', $reparation->statut) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="termine" {{ old('statut', $reparation->statut) == 'termine' ? 'selected' : '' }}>Terminé</option>
                <option value="urgent" {{ old('statut', $reparation->statut) == 'urgent' ? 'selected' : '' }}>Urgent</option>
                <option value="annule" {{ old('statut', $reparation->statut) == 'annule' ? 'selected' : '' }}>Annulé</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-accent hover:bg-accent-700 text-accent-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Mettre à jour</button>
            <a href="{{ route('vehicules.show', $reparation->vehicule_id) }}" class="bg-muted hover:bg-muted-foreground/10 text-muted-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Retour au véhicule</a>
        </div>
    </form>
    </div>
</div>

@endsection
