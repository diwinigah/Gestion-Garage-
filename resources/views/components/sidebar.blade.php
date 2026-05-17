{{-- Sidebar Component --}}
<div class="sidebar-inner">
    <div class="sidebar-header">
        <a href="/" class="sidebar-brand" data-sidebar-close>
            <span class="sidebar-logo">GG</span>
            <span>Gestion Garage</span>
        </a>

        <button type="button" class="sidebar-close" data-sidebar-close aria-label="Fermer le menu">
            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <nav class="sidebar-nav" aria-label="Menu principal">
        <a href="/" data-sidebar-close class="sidebar-link {{ request()->is('/') ? 'is-active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0 7-7 7 7M5 10v10a1 1 0 0 0 1 1h3m10-11 2 2m-2-2v10a1 1 0 0 1-1 1h-3m-6 0a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1m-6 0h6"></path>
            </svg>
            <span>Accueil</span>
        </a>

        <a href="{{ route('vehicules.index') }}" data-sidebar-close class="sidebar-link {{ request()->routeIs('vehicules*') ? 'is-active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm10 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM3 17h2m4 0h6m4 0h2M5 17l1.2-6.5A2 2 0 0 1 8.17 9h7.66a2 2 0 0 1 1.97 1.5L19 17M7 9l1-3h8l1 3"></path>
            </svg>
            <span>Véhicules</span>
        </a>

        <a href="{{ route('reparations.index') }}" data-sidebar-close class="sidebar-link {{ request()->routeIs('reparations*') ? 'is-active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065Z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
            </svg>
            <span>Réparations</span>
        </a>

        <a href="{{ route('techniciens.index') }}" data-sidebar-close class="sidebar-link {{ request()->routeIs('techniciens*') ? 'is-active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 0 0-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 0 1 5.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 0 1 9.288 0M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM7 10a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"></path>
            </svg>
            <span>Techniciens</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <button type="button" class="theme-toggle sidebar-link" aria-label="Basculer le thème">
            <svg class="sidebar-icon theme-icon theme-icon-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"></path>
            </svg>
            <svg class="sidebar-icon theme-icon theme-icon-dark hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 0 1 8.646 3.646 9.003 9.003 0 0 0 12 21a9.003 9.003 0 0 0 8.354-5.646Z"></path>
            </svg>
            <span>Mode sombre</span>
        </button>
    </div>
</div>
