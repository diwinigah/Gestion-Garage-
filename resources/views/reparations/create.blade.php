@extends('layouts.app')

@section('title', 'Ajouter une réparation')

@section('content')
<div class="page">
    <div class="page-header">
        <div>
            <h1 class="page-title">Ajouter une réparation</h1>
            <p class="page-subtitle">
                @isset($appointment)
                    Depuis le rendez-vous de {{ $appointment->full_name }}.
                @else
                    Créer une intervention pour un véhicule enregistré.
                @endisset
            </p>
        </div>
    </div>

    <section class="panel" style="margin-top: 1rem;">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @isset($appointment)
            <div class="alert">
                <strong>Rendez-vous :</strong> {{ $appointment->full_name }} - {{ $appointment->phone }}<br>
                <strong>Véhicule demandé :</strong> {{ $appointment->vehicle }}<br>
                <strong>Date souhaitée :</strong> {{ $appointment->desired_date?->format('d/m/Y') }}
            </div>
        @else
            <div class="alert">
                <strong>Véhicule :</strong> {{ $vehicule->immatriculation }} - {{ $vehicule->marque }} {{ $vehicule->modele }}
            </div>
        @endisset

        <form method="POST" action="{{ route('reparations.store') }}" class="form-grid">
            @csrf

            @isset($appointment)
                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                <div class="form-field-full">
                    <label class="form-label" for="vehicule_id">Véhicule enregistré</label>
                    <select class="form-control" name="vehicule_id" id="vehicule_id" required>
                        <option value="">Choisir un véhicule</option>
                        @foreach($vehicules as $item)
                            <option value="{{ $item->id }}" @selected(old('vehicule_id', $vehicule?->id) == $item->id)>
                                {{ $item->immatriculation }} - {{ $item->marque }} {{ $item->modele }}
                            </option>
                        @endforeach
                    </select>
                    <small class="muted">Si le véhicule n'existe pas encore, ajoutez-le d'abord dans la section Véhicules.</small>
                </div>
            @else
                <input type="hidden" name="vehicule_id" value="{{ $vehicule->id }}">
            @endisset

            <div class="form-field">
                <label class="form-label" for="date_debut">Date début</label>
                <input class="form-control" type="date" name="date_debut" id="date_debut" value="{{ old('date_debut', isset($appointment) ? $appointment->desired_date?->format('Y-m-d') : '') }}" required>
            </div>

            <div class="form-field">
                <label class="form-label" for="date_fin">Date fin</label>
                <input class="form-control" type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}">
            </div>

            <div class="form-field-full">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" name="description" id="description" required>@isset($appointment){{ old('description', "Client: {$appointment->full_name}\nTéléphone: {$appointment->phone}\nVéhicule demandé: {$appointment->vehicle}\nProblème: {$appointment->problem_description}") }}@else{{ old('description') }}@endisset</textarea>
            </div>

            <div class="form-field-full">
                <label class="form-label" for="technicien_id">Technicien</label>
                <select class="form-control" name="technicien_id" id="technicien_id">
                    <option value="">Non assigné</option>
                    @foreach ($techniciens as $technicien)
                        <option value="{{ $technicien->id }}" @selected(old('technicien_id') == $technicien->id)>
                            {{ $technicien->prenom }} {{ $technicien->nom }} ({{ $technicien->specialite }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-field-full actions-row">
                <a class="btn-muted" href="@isset($appointment){{ route('appointments.index') }}@else{{ route('vehicules.show', $vehicule->id) }}@endisset">Retour</a>
                <button class="btn" type="submit">Enregistrer</button>
            </div>
        </form>
    </section>
</div>
@endsection
