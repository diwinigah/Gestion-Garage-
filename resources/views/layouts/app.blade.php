<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>@yield('title', 'Gestion Garage')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-background text-foreground font-sans transition-colors duration-300 flex flex-col lg:flex-row" x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">

{{-- Overlay pour mobile --}}
<div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden transition-opacity duration-300" x-transition:enter="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="opacity-100" x-transition:leave-end="opacity-0"></div>

{{-- Sidebar mobile --}}
<aside x-show="sidebarOpen" class="fixed left-0 top-0 h-screen w-64 bg-card border-r border-border z-50 lg:hidden" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
    @include('components.sidebar')
</aside>

{{-- Sidebar desktop --}}
<aside class="hidden lg:flex flex-col w-64 bg-card border-r border-border flex-shrink-0">
    @include('components.sidebar')
</aside>

{{-- Contenu principal --}}
<main class="flex-1 flex flex-col min-h-screen pt-16 lg:pt-0">
    <div class="flex-1 overflow-y-auto">
        @yield('content')
    </div>
</main>

{{-- Bouton menu mobile --}}
<button @click="sidebarOpen = true" class="fixed bottom-6 left-6 z-40 lg:hidden p-3 bg-primary text-primary-foreground rounded-full shadow-lg hover:bg-primary/90 transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

{{-- Scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle thème
        const themeToggles = document.querySelectorAll('.theme-toggle');
        const html = document.documentElement;

        if (themeToggles.length > 0) {
            // Vérifier la préférence sauvegardée ou défaut au mode clair
            const currentTheme = localStorage.getItem('theme') || 'light';
            if (currentTheme === 'dark') {
                html.classList.add('dark');
                updateThemeIcons('dark');
            } else {
                updateThemeIcons('light');
            }

            themeToggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    if (html.classList.contains('dark')) {
                        html.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                        updateThemeIcons('light');
                    } else {
                        html.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                        updateThemeIcons('dark');
                    }
                });
            });
        }

        function updateThemeIcons(theme) {
            const lightIcons = document.querySelectorAll('.theme-icon-light');
            const darkIcons = document.querySelectorAll('.theme-icon-dark');
            if (theme === 'dark') {
                lightIcons.forEach(icon => icon.classList.add('hidden'));
                darkIcons.forEach(icon => icon.classList.remove('hidden'));
            } else {
                lightIcons.forEach(icon => icon.classList.remove('hidden'));
                darkIcons.forEach(icon => icon.classList.add('hidden'));
            }
        }
    });

    // Fermer sidebar sur redimensionnement desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            const sidebarData = document.querySelector('[x-data*="sidebarOpen"]');
            if (sidebarData && sidebarData.__x) {
                sidebarData.__x.$data.sidebarOpen = false;
            }
        }
    });
</script>

</body>
</html>
