(function () {
    "use strict";

    function animateNumber(element) {
        var raw = element.textContent.replace(/\s/g, "");
        var target = parseInt(raw, 10);

        if (!target || element.dataset.animatedNumber) {
            return;
        }

        element.dataset.animatedNumber = "true";

        var duration = 900;
        var start = null;

        function tick(timestamp) {
            if (!start) {
                start = timestamp;
            }

            var progress = Math.min((timestamp - start) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            element.textContent = Math.floor(target * eased).toLocaleString("fr-FR");

            if (progress < 1) {
                window.requestAnimationFrame(tick);
            }
        }

        window.requestAnimationFrame(tick);
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".stat-card strong, .stat-card .value, .dashboard-card strong, .dashboard-card .value").forEach(animateNumber);

        document.querySelectorAll("table").forEach(function (table) {
            if (!table.parentElement.classList.contains("table-wrapper") && !table.parentElement.classList.contains("table-responsive")) {
                var wrapper = document.createElement("div");
                wrapper.className = "table-wrapper";
                table.parentNode.insertBefore(wrapper, table);
                wrapper.appendChild(table);
            }
        });

        document.querySelectorAll("form").forEach(function (form) {
            form.addEventListener("submit", function () {
                var submit = form.querySelector("button[type='submit'], input[type='submit']");

                if (submit) {
                    submit.classList.add("is-loading");
                }
            });
        });
    });
})();
