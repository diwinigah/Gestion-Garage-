<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>@yield('title', 'Gestion Garage')</title>

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-body bg-background text-foreground font-sans transition-colors duration-300">
<div class="app-shell" data-sidebar-state="closed">
    <button type="button" class="sidebar-overlay" data-sidebar-close aria-label="Fermer le menu"></button>

    <aside class="app-sidebar" id="app-sidebar" aria-label="Navigation principale">
        @include('components.sidebar')
    </aside>

    <div class="app-content">
        <header class="mobile-topbar">
            <button type="button" class="hamburger-button" data-sidebar-toggle aria-controls="app-sidebar" aria-expanded="false" aria-label="Ouvrir le menu">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>

            <a href="/" class="mobile-brand" aria-label="Accueil Gestion Garage">Gestion Garage</a>

            <button type="button" class="mobile-theme-button theme-toggle" aria-label="Basculer le thème">
                <svg class="theme-icon theme-icon-light" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <svg class="theme-icon theme-icon-dark hidden" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
            </button>
        </header>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
