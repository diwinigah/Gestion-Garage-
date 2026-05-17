document.addEventListener('DOMContentLoaded', function () {
    var html = document.documentElement;
    var shell = document.querySelector('.app-shell');
    var sidebarToggle = document.querySelector('[data-sidebar-toggle]');
    var closeButtons = document.querySelectorAll('[data-sidebar-close]');
    var desktopQuery = window.matchMedia('(min-width: 1024px)');

    function setThemeIcons() {
        var dark = html.classList.contains('dark');
        document.querySelectorAll('.theme-icon-light').forEach(function (icon) {
            icon.classList.toggle('hidden', dark);
        });
        document.querySelectorAll('.theme-icon-dark').forEach(function (icon) {
            icon.classList.toggle('hidden', !dark);
        });
    }

    function closeSidebar() {
        if (!shell) return;
        shell.dataset.sidebarState = 'closed';
        document.body.classList.remove('no-scroll');
        if (sidebarToggle) {
            sidebarToggle.setAttribute('aria-expanded', 'false');
            sidebarToggle.setAttribute('aria-label', 'Ouvrir le menu');
        }
    }

    function openSidebar() {
        if (!shell || desktopQuery.matches) return;
        shell.dataset.sidebarState = 'open';
        document.body.classList.add('no-scroll');
        if (sidebarToggle) {
            sidebarToggle.setAttribute('aria-expanded', 'true');
            sidebarToggle.setAttribute('aria-label', 'Fermer le menu');
        }
    }

    if (localStorage.getItem('theme') === 'dark') {
        html.classList.add('dark');
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            shell && shell.dataset.sidebarState === 'open' ? closeSidebar() : openSidebar();
        });
    }

    closeButtons.forEach(function (button) {
        button.addEventListener('click', closeSidebar);
    });

    document.querySelectorAll('.theme-toggle').forEach(function (button) {
        button.addEventListener('click', function () {
            var dark = html.classList.toggle('dark');
            localStorage.setItem('theme', dark ? 'dark' : 'light');
            setThemeIcons();
        });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeSidebar();
    });

    desktopQuery.addEventListener('change', function (event) {
        if (event.matches) closeSidebar();
    });

    setThemeIcons();
});
