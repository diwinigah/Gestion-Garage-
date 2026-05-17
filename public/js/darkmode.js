window.GarageDarkMode = (function () {
    function setThemeIcons() {
        var dark = document.documentElement.classList.contains('dark');
        document.querySelectorAll('.theme-icon-light').forEach(function (icon) {
            icon.classList.toggle('hidden', dark);
        });
        document.querySelectorAll('.theme-icon-dark').forEach(function (icon) {
            icon.classList.toggle('hidden', !dark);
        });
    }

    function init() {
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }

        document.querySelectorAll('.theme-toggle').forEach(function (button) {
            button.addEventListener('click', function () {
                var dark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', dark ? 'dark' : 'light');
                setThemeIcons();
            });
        });

        setThemeIcons();
    }

    return { init: init };
})();
