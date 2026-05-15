{{-- Composant Badge Statut --}}
@php
    $statusClasses = [
        // Statuts réparations
        'en_attente' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
        'en_cours' => 'bg-blue-100 text-blue-800 border-blue-200',
        'termine' => 'bg-green-100 text-green-800 border-green-200',
        'urgent' => 'bg-red-100 text-red-800 border-red-200',
        'annule' => 'bg-gray-100 text-gray-800 border-gray-200',
        // Statuts techniciens
        'actif' => 'bg-green-100 text-green-800 border-green-200',
        'inactif' => 'bg-gray-100 text-gray-800 border-gray-200',
        'conge' => 'bg-orange-100 text-orange-800 border-orange-200',
    ];

    $statusLabels = [
        // Statuts réparations
        'en_attente' => 'En attente',
        'en_cours' => 'En cours',
        'termine' => 'Terminé',
        'urgent' => 'Urgent',
        'annule' => 'Annulé',
        // Statuts techniciens
        'actif' => 'Actif',
        'inactif' => 'Inactif',
        'conge' => 'En congé',
    ];
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
    {{ $statusLabels[$status] ?? ucfirst($status) }}
</span>