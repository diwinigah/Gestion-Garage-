<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion administrateur - Gestion Garage</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/darkmode.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <script defer src="{{ asset('js/darkmode.js') }}"></script>
    <script defer src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <main class="auth-page">
        <section class="auth-card">
            <h1 class="auth-title">Administration</h1>
            <p class="auth-subtitle">Connectez-vous pour gérer le garage, les rendez-vous et les interventions.</p>

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

            <form method="POST" action="{{ route('login.store') }}" class="form-grid">
                @csrf
                <div class="form-field-full">
                    <label class="form-label" for="email">Email administrateur</label>
                    <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                </div>

                <div class="form-field-full">
                    <label class="form-label" for="password">Mot de passe</label>
                    <input class="form-control" id="password" type="password" name="password" autocomplete="current-password" required>
                </div>

                <div class="form-field-full">
                    <label>
                        <input type="checkbox" name="remember" value="1">
                        Se souvenir de moi
                    </label>
                </div>

                <div class="form-field-full actions-row">
                    <a class="btn-muted" href="{{ url('/') }}">Retour au site</a>
                    <button class="btn" type="submit">Se connecter</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
