(function () {
    "use strict";

    var prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    var revealItems = document.querySelectorAll(".reveal");
    var counters = document.querySelectorAll("[data-count]");
    var hero = document.querySelector(".home-hero");
    var navbar = document.querySelector("[data-home-navbar]");
    var menuToggle = document.querySelector("[data-home-menu-toggle]");
    var menu = document.querySelector("[data-home-menu]");
    var menuOverlay = document.querySelector("[data-home-menu-overlay]");

    function setNavbarState() {
        if (!navbar) {
            return;
        }

        navbar.classList.toggle("is-scrolled", window.scrollY > 24);
    }

    function closeMenu() {
        if (!navbar || !menuToggle) {
            return;
        }

        navbar.classList.remove("is-open");
        document.body.classList.remove("home-menu-open");
        menuToggle.setAttribute("aria-expanded", "false");

        if (menuOverlay) {
            menuOverlay.classList.remove("is-visible");
        }
    }

    function toggleMenu() {
        if (!navbar || !menuToggle) {
            return;
        }

        var isOpen = navbar.classList.toggle("is-open");
        document.body.classList.toggle("home-menu-open", isOpen);
        menuToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");

        if (menuOverlay) {
            menuOverlay.classList.toggle("is-visible", isOpen);
        }
    }

    function revealVisibleItems() {
        if (!revealItems.length) {
            return;
        }

        revealItems.forEach(function (item) {
            var rect = item.getBoundingClientRect();
            var trigger = window.innerHeight * 0.88;

            if (rect.top < trigger) {
                item.classList.add("is-visible");
            }
        });
    }

    function animateCounter(counter) {
        var target = parseInt(counter.getAttribute("data-count"), 10) || 0;
        var suffix = counter.getAttribute("data-suffix") || "";
        var duration = 1450;
        var startTime = null;

        function tick(timestamp) {
            if (!startTime) {
                startTime = timestamp;
            }

            var progress = Math.min((timestamp - startTime) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            counter.textContent = Math.floor(target * eased).toLocaleString("fr-FR") + suffix;

            if (progress < 1) {
                window.requestAnimationFrame(tick);
            }
        }

        window.requestAnimationFrame(tick);
    }

    function observeCounters() {
        if (!counters.length) {
            return;
        }

        if (!("IntersectionObserver" in window) || prefersReducedMotion) {
            counters.forEach(function (counter) {
                counter.textContent = (parseInt(counter.getAttribute("data-count"), 10) || 0).toLocaleString("fr-FR") + (counter.getAttribute("data-suffix") || "");
            });
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting && !entry.target.dataset.counted) {
                    entry.target.dataset.counted = "true";
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.45 });

        counters.forEach(function (counter) {
            observer.observe(counter);
        });
    }

    function updateParallax() {
        if (!hero || prefersReducedMotion || window.innerWidth < 881) {
            return;
        }

        var offset = Math.min(window.scrollY * 0.18, 90);
        hero.style.backgroundPosition = "center calc(50% + " + offset + "px)";
    }

    function onScroll() {
        setNavbarState();
        revealVisibleItems();
        updateParallax();
    }

    document.addEventListener("DOMContentLoaded", function () {
        setNavbarState();
        revealVisibleItems();
        observeCounters();
        updateParallax();

        if (menuToggle) {
            menuToggle.addEventListener("click", toggleMenu);
        }

        if (menuOverlay) {
            menuOverlay.addEventListener("click", closeMenu);
        }

        if (menu) {
            menu.querySelectorAll("a").forEach(function (link) {
                link.addEventListener("click", closeMenu);
            });
        }

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape") {
                closeMenu();
            }
        });
    });

    window.addEventListener("scroll", onScroll, { passive: true });
    window.addEventListener("resize", updateParallax);
})();
