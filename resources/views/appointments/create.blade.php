<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre rendez-vous - Gestion Garage</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/darkmode.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>
<body class="public-page">
    <header class="public-header">
        <nav class="public-nav">
            <a class="sidebar-brand" href="{{ url('/') }}"><span class="sidebar-logo">GG</span><span>Gestion Garage</span></a>
            <div class="public-links">
                <a href="{{ url('/') }}">Accueil</a>
                <a href="{{ route('login') }}">Admin</a>
            </div>
        </nav>
    </header>

    <main class="page">
        <section class="page-header">
            <div>
                <h1 class="page-title">Prendre rendez-vous</h1>
                <p class="page-subtitle">Décrivez votre besoin, nous vous rappelons pour confirmer le créneau.</p>
            </div>
        </section>

        <section class="panel" style="margin-top: 1rem;">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('appointments.store') }}" class="form-grid">
                @csrf
                <div class="form-field">
                    <label class="form-label" for="full_name">Nom complet</label>
                    <input class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                </div>

                <div class="form-field">
                    <label class="form-label" for="phone">Téléphone</label>
                    <input class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                </div>

                <div class="form-field">
                    <label class="form-label" for="vehicle">Véhicule</label>
                    <input class="form-control" id="vehicle" name="vehicle" value="{{ old('vehicle') }}" placeholder="Ex: Toyota Corolla AB-123-CD" required>
                </div>

                <div class="form-field">
                    <label class="form-label" for="desired_date">Date souhaitée</label>
                    <input class="form-control" id="desired_date" type="date" name="desired_date" value="{{ old('desired_date') }}" required>
                </div>

                <div class="form-field-full">
                    <label class="form-label" for="problem_description">Description du problème</label>
                    <textarea class="form-control" id="problem_description" name="problem_description" required>{{ old('problem_description') }}</textarea>
                </div>

                <div class="form-field-full actions-row">
                    <a class="btn-muted" href="{{ url('/') }}">Annuler</a>
                    <button class="btn" type="submit">Envoyer la demande</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
