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

    <div class="flex flex-col sm:flex-row gap-4 mb-8">
        <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="bg-primary hover:bg-primary-700 text-primary-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Modifier</a>
        <a href="{{ route('reparations.create', $vehicule->id) }}" class="bg-accent hover:bg-accent-700 text-accent-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Ajouter une réparation</a>
        <a href="{{ route('vehicules.index') }}" class="bg-muted hover:bg-muted-foreground/10 text-muted-foreground font-semibold py-2 px-4 rounded-lg shadow transition-colors">Retour à la liste</a>
    </div>

    <hr class="my-8 border-border">

    <h2 class="text-2xl font-bold mb-4 text-primary">Réparations du véhicule</h2>

    @php
        $tableHeaders = [
            ['label' => 'Date début', 'key' => 'date_debut', 'sortable' => true],
            ['label' => 'Date fin', 'key' => 'date_fin', 'sortable' => true],
            ['label' => 'Description', 'key' => 'description', 'sortable' => false],
            ['label' => 'Technicien', 'key' => 'technicien', 'sortable' => false],
        ];

        $tableRows = $vehicule->reparations->map(function($reparation) {
            return [
                'date_debut' => $reparation->date_debut ? \Carbon\Carbon::parse($reparation->date_debut)->format('d/m/Y') : '-',
                'date_fin' => $reparation->date_fin ? \Carbon\Carbon::parse($reparation->date_fin)->format('d/m/Y') : '-',
                'description' => $reparation->description,
                'technicien' => $reparation->technicien->nom ?? 'Non assigné',
                'actions' => [
                    [
                        'label' => 'Modifier',
                        'url' => route('reparations.edit', $reparation->id),
                        'color' => 'primary'
                    ],
                    [
                        'label' => 'Supprimer',
                        'url' => '#',
                        'onclick' => "if(confirm('Êtes-vous sûr de vouloir supprimer cette réparation ?')) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = '" . route('reparations.destroy', $reparation->id) . "';
                            const csrf = document.createElement('input');
                            csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '" . csrf_token() . "';
                            const method = document.createElement('input');
                            method.type = 'hidden'; method.name = '_method'; method.value = 'DELETE';
                            form.appendChild(csrf); form.appendChild(method);
                            document.body.appendChild(form); form.submit();
                        }",
                        'color' => 'red'
                    ]
                ]
            ];
        })->toArray();
    @endphp

    <x-data-table
        title="Historique des réparations"
        :headers="$tableHeaders"
        :rows="$tableRows"
    />

    </div>
</div>
@endsection
