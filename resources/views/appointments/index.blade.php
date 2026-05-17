@extends('layouts.app')

@section('title', 'Rendez-vous - Gestion Garage')

@section('content')
<div class="page">
    <div class="page-header">
        <div>
            <h1 class="page-title">Rendez-vous</h1>
            <p class="page-subtitle">Demandes clients, confirmation et suivi des interventions.</p>
        </div>
        <a class="btn-muted" href="{{ route('appointments.create') }}">Formulaire public</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin-top: 1rem;">{{ session('success') }}</div>
    @endif

    <section class="panel" style="margin-top: 1rem;">
        <form method="GET" action="{{ route('appointments.index') }}" class="toolbar">
            <input class="form-control" style="max-width: 360px;" type="search" name="search" value="{{ request('search') }}" placeholder="Nom, telephone, vehicule...">
            <select class="form-control" style="max-width: 220px;" name="status">
                <option value="">Tous les statuts</option>
                @foreach(\App\Models\Appointment::STATUSES as $status => $label)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ $label }}</option>
                @endforeach
            </select>
            <button class="btn" type="submit">Rechercher</button>
            @if(request()->hasAny(['search', 'status']))
                <a class="btn-muted" href="{{ route('appointments.index') }}">Effacer</a>
            @endif
        </form>
    </section>

    <section class="table-wrap" style="margin-top: 1rem;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Véhicule</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td>
                            <strong>{{ $appointment->full_name }}</strong><br>
                            <span class="muted">{{ $appointment->phone }}</span><br>
                            <span class="muted">{{ Str::limit($appointment->problem_description, 80) }}</span>
                        </td>
                        <td>{{ $appointment->vehicle }}</td>
                        <td>{{ $appointment->desired_date?->format('d/m/Y') }}</td>
                        <td><span class="status-badge status-{{ $appointment->status }}">{{ $appointment->statusLabel() }}</span></td>
                        <td>
                            <div class="actions-inline">
                                @if($appointment->status === 'pending')
                                    <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button class="btn-success" type="submit">Confirmer</button>
                                    </form>
                                @endif

                                @if($appointment->status === 'confirmed')
                                    <a class="btn" href="{{ route('appointments.repair.create', $appointment) }}">Créer réparation</a>
                                @endif

                                @if(in_array($appointment->status, ['confirmed', 'repair_created']))
                                    <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="completed">
                                        <button class="btn-success" type="submit">Terminer</button>
                                    </form>
                                @endif

                                @if(! in_array($appointment->status, ['completed', 'cancelled']))
                                    <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button class="btn-danger" type="submit">Annuler</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="muted">Aucun rendez-vous trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <div class="pagination">{{ $appointments->links() }}</div>
</div>
@endsection
