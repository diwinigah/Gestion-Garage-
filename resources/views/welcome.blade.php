<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion Garage - Accueil</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white"> Garage Z</h1>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="#accueil" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Accueil</a>
                    <a href="#services" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Services</a>
                    <a href="#about" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">À propos</a>
                    <a href="#contact" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Contact</a>
                    <a href="{{ route('vehicules.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Véhicules</a>
                    <a href="{{ route('techniciens.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Techniciens</a>
                    <a href="{{ route('reparations.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Réparations</a>
                    <a href="{{ route('dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Dashboard</a>
                </nav>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <a href="#accueil" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Accueil</a>
                <a href="#services" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Services</a>
                <a href="#about" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">À propos</a>
                <a href="#contact" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Contact</a>
                <a href="{{ route('vehicules.index') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Véhicules</a>
                <a href="{{ route('techniciens.index') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Techniciens</a>
                <a href="{{ route('reparations.index') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Réparations</a>
                <a href="{{ route('dashboard') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Dashboard</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="accueil" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-6xl font-bold mb-6">Bienvenue chez Garage Z</h2>
            <p class="text-xl md:text-2xl mb-8">Votre partenaire de confiance pour l'entretien et la réparation de véhicules</p>
            <a href="#contact" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">Contactez-nous</a>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">Nos Services</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Réparation Mécanique</h4>
                    <p class="text-gray-600 dark:text-gray-300">Entretien complet de votre véhicule avec des techniciens qualifiés.</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Révision Générale</h4>
                    <p class="text-gray-600 dark:text-gray-300">Contrôle approfondi pour assurer la sécurité et la performance.</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Dépannage</h4>
                    <p class="text-gray-600 dark:text-gray-300">Service de dépannage rapide 24/7 pour vos urgences.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    
                    <img src="https://via.placeholder.com/600x400?text=Garage" alt="Notre garage" class="rounded-lg shadow-md">
                </div>
                <div class="lg:w-1/2 lg:pl-12">
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">À propos de nous</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Depuis plus de 20 ans, Garage Z s'engage à fournir des services de qualité supérieure pour l'entretien et la réparation de véhicules.
                        Notre équipe de techniciens expérimentés utilise les dernières technologies pour garantir votre satisfaction.
                    </p>
                    <p class="text-gray-600 dark:text-gray-300">
                        Nous sommes fiers de notre réputation de fiabilité et de transparence dans tous nos services.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">Contactez-nous</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Informations</h4>
                    <p class="text-gray-600 dark:text-gray-300 mb-2"><strong>Adresse:</strong> Togo, Ville de Lomé</p>
                    <p class="text-gray-600 dark:text-gray-300 mb-2"><strong>Téléphone:</strong> +228 93 40 37 68</p>
                    <p class="text-gray-600 dark:text-gray-300 mb-2"><strong>Email:</strong> winidorc1@gmail.com</p>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Horaires:</strong> Lun-Ven 8h-18h, Sam 9h-12h</p>
                </div>
                <div>
                    <form class="space-y-4">
                        <div>
                            <label for="name" class="block text-gray-700 dark:text-gray-300">Nom</label>
                            <input type="text" id="name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label for="message" class="block text-gray-700 dark:text-gray-300">Message</label>
                            <textarea id="message" rows="4" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h5 class="text-lg font-semibold">Garage</h5>
                    <p class="text-gray-400">Votre garage de confiance</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#accueil" class="text-gray-400 hover:text-white">Accueil</a>
                    <a href="#services" class="text-gray-400 hover:text-white">Services</a>
                    <a href="#about" class="text-gray-400 hover:text-white">À propos</a>
                    <a href="#contact" class="text-gray-400 hover:text-white">Contact</a>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-8 text-center">
                <p class="text-gray-400">&copy; 2024 Gestion Garage. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Contact form handling
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.querySelector('#contact form');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const name = document.getElementById('name').value.trim();
                    const email = document.getElementById('email').value.trim();
                    const message = document.getElementById('message').value.trim();

                    // Validation simple
                    if (!name || !email || !message) {
                        alert('Veuillez remplir tous les champs.');
                        return;
                    }

                    if (!isValidEmail(email)) {
                        alert('Veuillez entrer une adresse email valide.');
                        return;
                    }

                    // Simulation d'envoi
                    const submitButton = contactForm.querySelector('button[type="submit"]');
                    const originalText = submitButton.textContent;
                    submitButton.textContent = 'Envoi en cours...';
                    submitButton.disabled = true;

                    // Simuler un délai d'envoi
                    setTimeout(function() {
                        alert('Merci pour votre message ! Nous vous contacterons bientôt.');
                        contactForm.reset();
                        submitButton.textContent = originalText;
                        submitButton.disabled = false;
                    }, 2000);
                });
            }

            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
        });
    </script>
</body>
</html>
