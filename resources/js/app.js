import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const html = document.documentElement;
    const shell = document.querySelector('.app-shell');
    const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
    const sidebarCloseButtons = document.querySelectorAll('[data-sidebar-close]');
    const themeToggles = document.querySelectorAll('.theme-toggle');
    const desktopQuery = window.matchMedia('(min-width: 1024px)');

    const setThemeIcons = () => {
        const isDark = html.classList.contains('dark');

        document.querySelectorAll('.theme-icon-light').forEach((icon) => {
            icon.classList.toggle('hidden', isDark);
        });

        document.querySelectorAll('.theme-icon-dark').forEach((icon) => {
            icon.classList.toggle('hidden', !isDark);
        });
    };

    const openSidebar = () => {
        if (!shell || desktopQuery.matches) {
            return;
        }

        shell.dataset.sidebarState = 'open';
        document.body.classList.add('overflow-hidden');
        sidebarToggle?.setAttribute('aria-expanded', 'true');
        sidebarToggle?.setAttribute('aria-label', 'Fermer le menu');
    };

    const closeSidebar = () => {
        if (!shell) {
            return;
        }

        shell.dataset.sidebarState = 'closed';
        document.body.classList.remove('overflow-hidden');
        sidebarToggle?.setAttribute('aria-expanded', 'false');
        sidebarToggle?.setAttribute('aria-label', 'Ouvrir le menu');
    };

    sidebarToggle?.addEventListener('click', () => {
        const isOpen = shell?.dataset.sidebarState === 'open';
        isOpen ? closeSidebar() : openSidebar();
    });

    sidebarCloseButtons.forEach((button) => {
        button.addEventListener('click', closeSidebar);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeSidebar();
        }
    });

    desktopQuery.addEventListener('change', (event) => {
        if (event.matches) {
            closeSidebar();
        }
    });

    themeToggles.forEach((toggle) => {
        toggle.addEventListener('click', () => {
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            setThemeIcons();
        });
    });

    setThemeIcons();
});
