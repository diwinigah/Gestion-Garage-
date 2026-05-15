@extends('layouts.app')

@section('title', 'Modifier véhicule')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-4xl mx-auto w-full">
    <div class="bg-card text-card-foreground rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold mb-6 text-primary">Modifier le véhicule</h1>

    @if ($errors->any())
        <ul class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('vehicules.update', $vehicule->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="immatriculation" class="block text-sm font-medium text-foreground">Immatriculation *</label>
                <input type="text" name="immatriculation" id="immatriculation"
                       value="{{ $vehicule->immatriculation }}" required
                       class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="marque" class="block text-sm font-medium text-foreground">Marque *</label>
                <input type="text" name="marque" id="marque"
                       value="{{ $vehicule->marque }}" required
                       class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="modele" class="block text-sm font-medium text-foreground">Modèle *</label>
                <input type="text" name="modele" id="modele"
                       value="{{ $vehicule->modele }}" required
                       class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="couleur" class="block text-sm font-medium text-foreground">Couleur</label>
                <input type="text" name="couleur" id="couleur"
                       value="{{ $vehicule->couleur }}"
                       class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="annee" class="block text-sm font-medium text-foreground">Année</label>
                <input type="number" name="annee" id="annee"
                       value="{{ $vehicule->annee }}"
                       class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="kilometrage" class="block text-sm font-medium text-foreground">Kilométrage</label>
                <input type="number" name="kilometrage" id="kilometrage"
                       value="{{ $vehicule->kilometrage }}"
                       class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
            </div>

            <div>
                <label for="energie" class="block text-sm font-medium text-foreground">Énergie</label>
                <select name="energie" id="energie"
                        class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
                    <option value="">-- Choisir --</option>
                    <option value="essence" {{ $vehicule->energie == 'essence' ? 'selected' : '' }}>Essence</option>
                    <option value="diesel" {{ $vehicule->energie == 'diesel' ? 'selected' : '' }}>Diesel</option>
                    <option value="hybride" {{ $vehicule->energie == 'hybride' ? 'selected' : '' }}>Hybride</option>
                    <option value="electrique" {{ $vehicule->energie == 'electrique' ? 'selected' : '' }}>Électrique</option>
                </select>
            </div>

            <div>
                <label for="boite" class="block text-sm font-medium text-foreground">Boîte</label>
                <select name="boite" id="boite"
                        class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
                    <option value="">-- Choisir --</option>
                    <option value="manuelle" {{ $vehicule->boite == 'manuelle' ? 'selected' : '' }}>Manuelle</option>
                    <option value="automatique" {{ $vehicule->boite == 'automatique' ? 'selected' : '' }}>Automatique</option>
                </select>
            </div>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-foreground">Nouvelle image</label>
            <input type="file" name="image" id="image" accept="image/*"
                   class="mt-1 block w-full px-3 py-2 border border-border rounded-md shadow-sm bg-input text-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:border-transparent">
        </div>

        @if ($vehicule->image)
            <div>
                <label class="block text-sm font-medium text-foreground">Image actuelle</label>
                <img src="{{ route('image.serve', ['path' => $vehicule->image]) }}" alt="véhicule" class="mt-2 w-32 h-32 object-cover rounded border">
            </div>
        @endif

        <div class="flex space-x-4">
            <button type="submit" class="bg-accent hover:bg-accent-700 text-accent-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Mettre à jour</button>
            <a href="{{ route('vehicules.index') }}" class="bg-muted hover:bg-muted-foreground/10 text-muted-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Retour</a>
        </div>

    </form>
    </div>
</div>
@endsection
