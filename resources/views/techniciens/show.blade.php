@extends('layouts.app')

@section('title', 'Détails du Technicien')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-md mx-auto w-full">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold text-primary-600 mb-6">Détails du Technicien</h1>

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $technicien->nom }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prénom</label>
            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $technicien->prenom }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Spécialité</label>
            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $technicien->specialite ?? 'N/A' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Téléphone</label>
            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $technicien->telephone ?? 'N/A' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $technicien->email ?? 'N/A' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Statut</label>
            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $technicien->statut ? 'Actif' : 'Inactif' }}</p>
        </div>

    <div class="mt-6 flex justify-end">
        <a href="{{ route('techniciens.index') }}" class="mr-4 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-600 rounded-md hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors">Retour</a>
        <a href="{{ route('techniciens.edit', $technicien) }}" class="px-4 py-2 bg-accent text-white text-sm font-medium rounded-md hover:bg-accent-600 transition-colors shadow-sm">Éditer</a>
    </div>
    </div>
</div>
@endsection