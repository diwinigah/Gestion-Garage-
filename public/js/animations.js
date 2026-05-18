(function () {
    "use strict";

    var prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    var items = document.querySelectorAll(".ui-reveal, .fade-in, .reveal, .card, .stat-card, .dashboard-card, .form-card, .table-wrapper");

    if (prefersReducedMotion) {
        items.forEach(function (item) {
            item.classList.add("is-visible");
        });
        return;
    }

    function revealFallback() {
        items.forEach(function (item) {
            if (item.getBoundingClientRect().top < window.innerHeight * 0.9) {
                item.classList.add("is-visible");
            }
        });
    }

    if ("IntersectionObserver" in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        items.forEach(function (item) {
            item.classList.add("ui-reveal");
            observer.observe(item);
        });
    } else {
        revealFallback();
        window.addEventListener("scroll", revealFallback, { passive: true });
    }
})();
