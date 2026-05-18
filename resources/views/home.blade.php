<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Garage - Excellence & Précision</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/darkmode.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body class="home-page">
    @php
        $appointmentUrl = Route::has('rendez-vous.create') ? route('rendez-vous.create') : (Route::has('appointments.create') ? route('appointments.create') : url('/rendez-vous'));
        $adminUrl = Route::has('login') ? route('login') : url('/login');
    @endphp

    <header class="home-navbar" data-home-navbar>
        <div class="home-nav-inner">
            <a class="home-brand" href="#accueil" aria-label="Retour à l'accueil">
                <span class="home-brand-mark">G</span>
                <span class="home-brand-text">GARAGE<span class="brand-accent">Z</span></span>
            </a>

            <button class="home-menu-toggle" type="button" data-home-menu-toggle aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="home-navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="home-nav" id="home-navigation" data-home-menu>
                <a href="#accueil" class="nav-item">Accueil</a>
                <a href="#services" class="nav-item">Services</a>
                <a href="#apropos" class="nav-item">À propos</a>
                <a href="{{ $appointmentUrl }}" class="home-btn home-btn-primary nav-cta">Rendez-vous</a>
                <a href="{{ $adminUrl }}" class="nav-admin">Admin</a>
            </nav>
        </div>
    </header>
    <div class="home-menu-overlay" data-home-menu-overlay></div>

    <main class="home-shell">
        <section class="home-hero" id="accueil">
            <div class="home-container home-hero-grid">
                <div class="home-hero-copy reveal">
                    <span class="home-eyebrow">Expertise Automobile Premium</span>
                    <h1 class="home-hero-title">Votre garage automobile moderne et fiable</h1>
                    <p>Une approche rigoureuse pour l'entretien de votre véhicule. Nous combinons technologie de pointe et savoir-faire artisanal pour garantir votre sécurité et votre confort.</p>
                    <div class="home-actions">
                        <a class="home-btn home-btn-primary" href="{{ $appointmentUrl }}">Prendre rendez-vous</a>
                        <a class="home-btn home-btn-secondary" href="#services">Nos services</a>
                    </div>
                </div>

                <aside class="home-hero-panel reveal" aria-label="Engagements du garage">
                    <div class="panel-header">
                        <strong class="panel-number">24h</strong>
                        <span class="panel-text">Réponse rapide garantie pour vos demandes.</span>
                    </div>
                    <hr class="panel-divider">
                    <ul class="home-panel-list">
                        <li><span class="check-mark">✓</span> Diagnostic précis et transparent</li>
                        <li><span class="check-mark">✓</span> Techniciens certifiés experts</li>
                        <li><span class="check-mark">✓</span> Suivi professionnel rigoureux</li>
                    </ul>
                </aside>
            </div>
        </section>

        <section class="home-section home-services" id="services">
            <div class="home-container">
                <div class="home-section-head reveal">
                    <div class="head-content">
                        <span class="home-eyebrow">Nos Prestations</span>
                        <h2 class="home-section-title">Des services complets pour une performance durable</h2>
                    </div>
                    <p class="home-section-lead">De la maintenance courante aux interventions complexes, nous assurons la longévité de votre moteur et la sécurité de vos trajets.</p>
                </div>

                <div class="home-service-grid">
                    <article class="home-card reveal">
                        <span class="home-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18l3 3 6.3-6.3a4 4 0 0 0 5.4-5.4l-3 3-3-3 3-3Z"></path></svg>
                        </span>
                        <h3 class="card-title">Réparation Moteur</h3>
                        <p>Interventions mécaniques de haute précision pour restaurer la puissance et l'efficacité d'origine.</p>
                    </article>

                    <article class la="home-card reveal">
                        <span class="home-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14a8 8 0 1 1 16 0"></path><path d="M12 14l4-4"></path><path d="M5 20h14"></path></svg>
                        </span>
                        <h3 class="card-title">Diagnostic Expert</h3>
                        <p>Analyse électronique complète pour identifier précisément l'origine des pannes et optimiser les coûts.</p>
                    </article>

                    <article class="home-card reveal">
                        <span class="home-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2s6 7 6 12a6 6 0 0 1-12 0c0-5 6-12 6-12Z"></path></svg>
                        </span>
                        <h3 class="card-title">Vidange & Filtres</h3>
                        <p>Entretien rigoureux des fluides selon les normes constructeurs pour une protection moteur maximale.</p>
                    </article>

                    <article class="home-card reveal">
                        <span class="home-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17h18"></path><path d="M6 17l2-7h8l2 7"></path><circle cx="7" cy="18" r="2"></circle><circle cx="17" cy="18" r="2"></circle><path d="M9 10V7h6v3"></path></svg>
                        </span>
                        <h3 class="card-title">Maintenance</h3>
                        <p>Contrôles de sécurité, freinage et révisions périodiques pour une sérénité absolue sur la route.</p>
                    </article>

                    <article class="home-card reveal">
                        <span class="home-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 13l2-5h12l2 5"></path><path d="M5 13h14v6H5z"></path><path d="M7 19v2"></path><path d="M17 19v2"></path></svg>
                        </span>
                        <h3 class="card-title">Carrosserie</h3>
                        <p>Restauration esthétique et structurelle avec un souci du détail et des finitions premium.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="home-section home-stats" aria-label="Statistiques du garage">
            <div class="home-container home-stat-grid">
                <div class="home-stat reveal">
                    <strong data-count="1250" data-suffix="+">0</strong>
                    <span class="stat-label">Véhicules Réparés</span>
                </div>
                <div class="home-stat reveal">
                    <strong data-count="980" data-suffix="+">0</strong>
                    <span class="stat-label">Clients Satisfaits</span>
                </div>
                <div class="home-stat reveal">
                    <strong data-count="12">0</strong>
                    <span class="stat-label">Techniciens Experts</span>
                </div>
                <div class="home-stat reveal">
                    <strong data-count="15" data-suffix="+">0</strong>
                    <span class="stat-label">Années d'Expérience</span>
                </div>
            </div>
        </section>

        <section class="home-section home-about" id="apropos">
            <div class="home-container home-about-grid">
                <div class="home-about-text reveal">
                    <span class="home-eyebrow">Notre Histoire</span>
                    <h2 class="home-section-title">L'engagement d'un service irréprochable</h2>
                    <p>Notre mission est d'offrir une expérience claire, professionnelle et efficace. Nous ne nous contentons pas de réparer des véhicules ; nous assurons votre mobilité et votre sécurité.</p>
                    <p>Chaque intervention est guidée par la précision et la transparence, avec un suivi rigoureux pour chaque client.</p>
                    <ul class="home-checks">
                        <li><span class="check-mark">✓</span> Devis transparents et détaillés</li>
                        <li><span class="check-mark">✓</span> Matériel de diagnostic dernière génération</li>
                        <li><span class="check-mark">✓</span> Garantie sur toutes nos interventions</li>
                    </ul>
                </div>

                <div class="home-about-media reveal">
                    <div class="image-wrapper">
                        <img src="https://images.unsplash.com/photo-1607860108855-64acf2078ed9?auto=format&fit=crop&w=1200&q=80" alt="Atelier professionnel">
                        <div class="home-about-badge">
                            <strong class="badge-title">Qualité Certifiée</strong>
                            <span class="badge-text">Méthodes de travail structurées et rigoureuses.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="home-section home-appointment" id="rendez-vous">
            <div class="home-container">
                <div class="home-cta-box reveal">
                    <div class="cta-content">
                        <span class="home-eyebrow">Prise de Contact</span>
                        <h2 class="cta-title">Planifiez votre intervention en quelques clics</h2>
                        <p>Anticipez l'entretien de votre véhicule et bénéficiez d'une prise en charge prioritaire par nos experts.</p>
                    </div>
                    <a class="home-btn home-btn-primary" href="{{ $appointmentUrl }}">Prendre rendez-vous</a>
                </div>
            </div>
        </section>
    </main>

    <footer class="home-footer">
        <div class="home-container">
            <div class="home-footer-grid">
                <div class="footer-col">
                    <h3 class="footer-title">Garage Z</h3>
                    <p>Votre partenaire de confiance pour l'entretien, le diagnostic et la réparation automobile premium.</p>
                </div>
                <div class="footer-col">
                    <h4 class="footer-subtitle">Coordonnées</h4>
                    <ul class="footer-links">
                        <li><span class="icon">📞</span> <a href="tel:+22893403768">93 40 37 68</a></li>
                        <li><span class="icon">✉️</span > <a href="mailto:winidorc1@gmail.com">winidorc1@gmail.com</a></li>
                        <li><span class="icon">📍</span>Lomé /Togo</li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 class="footer-subtitle">Horaires</h4>
                    <ul class="footer-links">
                        <li>Lundi - Vendredi : 8h - 18h</li>
                        <li>Samedi : 9h - 13h</li>
                        <li>Dimanche : fermé</li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 class="footer-subtitle">Navigation</h4>
                    <ul class="footer-links">
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="{{ $appointmentUrl }}">Rendez-vous</a></li>
                        <li><a href="{{ $adminUrl }}">Espace Admin</a></li>
                    </ul>
                </div>
            </div>
            <div class="home-footer-bottom">
                <span>© {{ date('Y') }} Garage Z. Design Professionnel & Performance Durable.</span>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/home.js') }}" defer></script>
</body>
</html>
