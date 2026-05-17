@extends('layouts.app')

@section('title', 'Dashboard - Gestion Garage')

@section('content')
<div class="page">
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Vue d'ensemble du garage, des réparations et des rendez-vous.</p>
        </div>
        <div class="actions-inline">
            <a class="btn-muted" href="{{ url('/') }}">Voir le site</a>
            <a class="btn" href="{{ route('appointments.index') }}">Rendez-vous</a>
        </div>
    </div>

    <section class="grid-auto" style="margin-top: 1rem;">
        <article class="stat-card">
            <span class="stat-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17h18M6 17l1.2-6.5A2 2 0 0 1 9.17 9h5.66a2 2 0 0 1 1.97 1.5L18 17M8 17a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/></svg>
            </span>
            <div>
                <p class="stat-label">Total véhicules</p>
                <p class="stat-value">{{ $stats['vehicles_total'] }}</p>
            </div>
        </article>

        <article class="stat-card">
            <span class="stat-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.7 6.3 3 3M4 20l5.5-1.5L19 9a2.1 2.1 0 0 0-3-3l-9.5 9.5L4 20Z"/></svg>
            </span>
            <div>
                <p class="stat-label">Véhicules en réparation</p>
                <p class="stat-value">{{ $stats['vehicles_in_repair'] }}</p>
            </div>
        </article>

        <article class="stat-card">
            <span class="stat-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 0 0-8 0v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm6 10v-2a3 3 0 0 0-2-2.83M6 16.17A3 3 0 0 0 4 19v2"/></svg>
            </span>
            <div>
                <p class="stat-label">Techniciens</p>
                <p class="stat-value">{{ $stats['technicians_total'] }}</p>
            </div>
        </article>

        <article class="stat-card">
            <span class="stat-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 11h14M6 21h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"/></svg>
            </span>
            <div>
                <p class="stat-label">RDV en attente</p>
                <p class="stat-value">{{ $stats['appointments_pending'] }}</p>
            </div>
        </article>

        <article class="stat-card">
            <span class="stat-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 4 4L19 6"/></svg>
            </span>
            <div>
                <p class="stat-label">RDV confirmés</p>
                <p class="stat-value">{{ $stats['appointments_confirmed'] }}</p>
            </div>
        </article>

        <article class="stat-card">
            <span class="stat-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            </span>
            <div>
                <p class="stat-label">RDV terminés</p>
                <p class="stat-value">{{ $stats['appointments_completed'] }}</p>
            </div>
        </article>
    </section>

    <section class="dashboard-grid" style="margin-top: 1rem;">
        <article class="panel">
            <div class="page-header">
                <div>
                    <h2 style="margin: 0;">Activité mensuelle</h2>
                    <p class="page-subtitle">Réparations et rendez-vous des six derniers mois.</p>
                </div>
            </div>
            <canvas class="chart-box" id="activityChart" data-activity='@json($monthlyActivity)'></canvas>
        </article>

        <article class="panel">
            <h2 style="margin-top: 0;">Derniers rendez-vous</h2>
            <div class="list-stack">
                @forelse($latestAppointments as $appointment)
                    <div class="mini-item">
                        <strong>{{ $appointment->full_name }}</strong>
                        <span class="muted">{{ $appointment->vehicle }} - {{ $appointment->desired_date?->format('d/m/Y') }}</span>
                        <span class="status-badge status-{{ $appointment->status }}">{{ $appointment->statusLabel() }}</span>
                    </div>
                @empty
                    <p class="muted">Aucun rendez-vous récent.</p>
                @endforelse
            </div>
        </article>
    </section>

    <section class="panel" style="margin-top: 1rem;">
        <h2 style="margin-top: 0;">Dernières réparations</h2>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Véhicule</th>
                        <th>Description</th>
                        <th>Technicien</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestRepairs as $repair)
                        <tr>
                            <td>{{ $repair->vehicule?->marque }} {{ $repair->vehicule?->modele }}</td>
                            <td>{{ Str::limit($repair->description, 90) }}</td>
                            <td>{{ $repair->technicien?->prenom }} {{ $repair->technicien?->nom }}</td>
                            <td><span class="status-badge status-{{ $repair->statut }}">{{ $repair->statut }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="muted">Aucune réparation récente.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var canvas = document.getElementById('activityChart');
    if (!canvas) return;

    var data = JSON.parse(canvas.dataset.activity || '[]');
    var ctx = canvas.getContext('2d');
    var ratio = window.devicePixelRatio || 1;
    var rect = canvas.getBoundingClientRect();
    canvas.width = rect.width * ratio;
    canvas.height = 300 * ratio;
    ctx.scale(ratio, ratio);

    var width = rect.width;
    var height = 300;
    var padding = 36;
    var max = Math.max(1, ...data.map(function (item) {
        return Math.max(item.repairs, item.appointments);
    }));

    function point(index, value) {
        var x = padding + (index * ((width - padding * 2) / Math.max(1, data.length - 1)));
        var y = height - padding - ((value / max) * (height - padding * 2));
        return { x: x, y: y };
    }

    function drawLine(key, color) {
        ctx.beginPath();
        data.forEach(function (item, index) {
            var p = point(index, item[key]);
            index === 0 ? ctx.moveTo(p.x, p.y) : ctx.lineTo(p.x, p.y);
        });
        ctx.lineWidth = 3;
        ctx.strokeStyle = color;
        ctx.stroke();
    }

    ctx.clearRect(0, 0, width, height);
    ctx.strokeStyle = getComputedStyle(document.documentElement).getPropertyValue('--border');
    ctx.lineWidth = 1;
    for (var i = 0; i <= 4; i++) {
        var y = padding + i * ((height - padding * 2) / 4);
        ctx.beginPath();
        ctx.moveTo(padding, y);
        ctx.lineTo(width - padding, y);
        ctx.stroke();
    }

    ctx.fillStyle = getComputedStyle(document.documentElement).getPropertyValue('--muted');
    ctx.font = '12px sans-serif';
    data.forEach(function (item, index) {
        var p = point(index, 0);
        ctx.fillText(item.label, p.x - 10, height - 10);
    });

    drawLine('repairs', '#2563eb');
    drawLine('appointments', '#10b981');
});
</script>
@endsection
