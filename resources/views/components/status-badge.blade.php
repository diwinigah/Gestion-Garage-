@php
    $statusLabels = [
        'en_attente' => 'En attente',
        'en_cours' => 'En cours',
        'termine' => 'Terminé',
        'urgent' => 'Urgent',
        'annule' => 'Annulé',
        'actif' => 'Actif',
        'inactif' => 'Inactif',
        'conge' => 'En congé',
        'pending' => 'En attente',
        'confirmed' => 'Confirmé',
        'repair_created' => 'Réparation créée',
        'completed' => 'Terminé',
        'cancelled' => 'Annulé',
    ];
@endphp

<span class="status-badge status-{{ $status }}">
    {{ $statusLabels[$status] ?? ucfirst((string) $status) }}
</span>
