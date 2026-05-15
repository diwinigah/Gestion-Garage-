@extends('layouts.app')

@section('title', 'Ajouter une réparation')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-2xl mx-auto w-full">
    <div class="bg-card text-card-foreground rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold mb-6 text-primary">Ajouter une réparation</h1>

    @if ($errors->any())
        <ul class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <p class="mb-6 p-4 bg-muted rounded-lg"><strong class="text-muted-foreground">Véhicule :</strong> {{ $vehicule->immatriculation }} – {{ $vehicule->marque }} {{ $vehicule->modele }}</p>

    <form method="POST" action="{{ route('reparations.store') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="vehicule_id" value="{{ $vehicule->id }}">

        <div>
            <label for="date_debut" class="block text-sm font-medium text-foreground">Date début *</label>
            <input type="date" name="date_debut" id="date_debut" required class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
        </div>

        <div>
            <label for="date_fin" class="block text-sm font-medium text-foreground">Date fin</label>
            <input type="date" name="date_fin" id="date_fin" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-foreground">Description *</label>
            <textarea name="description" id="description" required rows="4" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent"></textarea>
        </div>

        <div>
            <label for="technicien_id" class="block text-sm font-medium text-foreground">Technicien</label>
            <select name="technicien_id" id="technicien_id" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
                <option value="">— Non assigné —</option>
                @foreach ($techniciens as $technicien)
                    <option value="{{ $technicien->id }}">
                        {{ $technicien->nom }} {{ $technicien->prenom }} ({{ $technicien->specialite }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-accent hover:bg-accent-700 text-accent-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Enregistrer</button>
            <a href="{{ route('vehicules.show', $vehicule->id) }}" class="bg-muted hover:bg-muted-foreground/10 text-muted-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Retour</a>
        </div>
    </form>
    </div>
</div>

@endsection
