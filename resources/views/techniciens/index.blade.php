@extends('layouts.app')

@section('title', 'Techniciens - Gestion Garage')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
    <div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-foreground">Techniciens</h1>
        <p class="text-muted-foreground">Gestion de l'équipe technique</p>
    </div>

    @if(session('success'))
        <x-toast :show="true" type="success" title="Succès" :message="session('success')" />
    @endif

    <x-data-table
        title="Liste des techniciens"
        :action-url="route('techniciens.create')"
        action-label="Ajouter un technicien"
        :headers="[
            ['label' => 'Nom', 'key' => 'nom', 'sortable' => true],
            ['label' => 'Prénom', 'key' => 'prenom', 'sortable' => true],
            ['label' => 'Spécialité', 'key' => 'specialite', 'sortable' => true],
            ['label' => 'Téléphone', 'key' => 'telephone', 'sortable' => false],
            ['label' => 'Email', 'key' => 'email', 'sortable' => false],
            ['label' => 'Statut', 'key' => 'statut', 'sortable' => true]
        ]"
        :rows="$techniciens->map(function($technicien) {
            return [
                'nom' => $technicien->nom,
                'prenom' => $technicien->prenom,
                'specialite' => $technicien->specialite ?? 'Non spécifiée',
                'telephone' => $technicien->telephone ?? 'Non spécifié',
                'email' => $technicien->email ?? 'Non spécifié',
                'statut' => $technicien->statut ? 'Actif' : 'Inactif',
                'actions' => [
                    ['label' => 'Voir', 'url' => route('techniciens.show', $technicien->id), 'color' => 'blue'],
                    ['label' => 'Modifier', 'url' => route('techniciens.edit', $technicien->id), 'color' => 'green'],
                    ['label' => 'Supprimer', 'url' => route('techniciens.destroy', $technicien->id), 'color' => 'red']
                ]
            ];
        })"
        :pagination="[
            'from' => $techniciens->firstItem(),
            'to' => $techniciens->lastItem(),
            'total' => $techniciens->total(),
            'prev_url' => $techniciens->previousPageUrl(),
            'next_url' => $techniciens->nextPageUrl()
        ]"
    />
</div>
@endsection