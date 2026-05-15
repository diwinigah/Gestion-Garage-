@extends('layouts.app')

@section('title', 'Ajouter un véhicule')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-4xl mx-auto w-full">
    <div class="bg-card text-card-foreground rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold mb-6 text-primary">Ajouter un véhicule</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-accent/10 border border-accent text-accent-foreground rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <ul class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('vehicules.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="immatriculation" class="block text-sm font-medium text-foreground">Immatriculation *</label>
                <input type="text" name="immatriculation" id="immatriculation" required class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="marque" class="block text-sm font-medium text-foreground">Marque *</label>
                <input type="text" name="marque" id="marque" required class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="modele" class="block text-sm font-medium text-foreground">Modèle *</label>
                <input type="text" name="modele" id="modele" required class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="couleur" class="block text-sm font-medium text-foreground">Couleur</label>
                <input type="text" name="couleur" id="couleur" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="annee" class="block text-sm font-medium text-foreground">Année</label>
                <input type="number" name="annee" id="annee" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="kilometrage" class="block text-sm font-medium text-foreground">Kilométrage</label>
                <input type="number" name="kilometrage" id="kilometrage" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="energie" class="block text-sm font-medium text-foreground">Énergie</label>
                <select name="energie" id="energie" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
                    <option value="">-- Choisir --</option>
                    <option value="essence">Essence</option>
                    <option value="diesel">Diesel</option>
                    <option value="hybride">Hybride</option>
                    <option value="electrique">Électrique</option>
                </select>
            </div>

            <div>
                <label for="boite" class="block text-sm font-medium text-foreground">Boîte</label>
                <select name="boite" id="boite" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
                    <option value="">-- Choisir --</option>
                    <option value="manuelle">Manuelle</option>
                    <option value="automatique">Automatique</option>
                </select>
            </div>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-foreground">Image du véhicule</label>
            <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-accent hover:bg-accent-700 text-accent-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Enregistrer</button>
            <a href="{{ route('vehicules.index') }}" class="bg-muted hover:bg-muted-foreground/10 text-muted-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Retour</a>
        </div>
    </form>
    </div>
</div>

@endsection
