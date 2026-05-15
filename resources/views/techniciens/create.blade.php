@extends('layouts.app')

@section('title', 'Ajouter un Technicien')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-md mx-auto w-full">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold text-primary-600 mb-6">Ajouter un Technicien</h1>

    <form action="{{ route('techniciens.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white" required>
            @error('nom')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white" required>
            @error('prenom')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="specialite" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Spécialité</label>
            <input type="text" name="specialite" id="specialite" value="{{ old('specialite') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            @error('specialite')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="telephone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Téléphone</label>
            <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            @error('telephone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Statut</label>
            <div class="mt-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="statut" value="actif" {{ old('statut', 'actif') == 'actif' ? 'checked' : '' }} class="form-radio h-4 w-4 text-primary-600">
                    <span class="ml-2">Actif</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" name="statut" value="inactif" {{ old('statut') == 'inactif' ? 'checked' : '' }} class="form-radio h-4 w-4 text-primary-600">
                    <span class="ml-2">Inactif</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" name="statut" value="conge" {{ old('statut') == 'conge' ? 'checked' : '' }} class="form-radio h-4 w-4 text-primary-600">
                    <span class="ml-2">Congé</span>
                </label>
            </div>
            @error('statut')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('techniciens.index') }}" class="mr-4 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-600 rounded-md hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors">Annuler</a>
            <button type="submit" class="px-4 py-2 bg-accent text-white text-sm font-medium rounded-md hover:bg-accent-600 transition-colors shadow-sm">Créer</button>
        </div>
    </form>
    </div>
</div>
@endsection