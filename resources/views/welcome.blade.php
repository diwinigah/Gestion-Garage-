<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Garage - Accueil</title>
    <link rel="stylesheet" href="{{ asset('css/garage.css') }}">
</head>
<body class="public-page">
    <header class="public-header">
        <nav class="public-nav">
            <a class="sidebar-brand" href="{{ url('/') }}"><span class="sidebar-logo">GG</span><span>Garage Z</span></a>
            <div class="public-links">
                <a href="#services">Services</a>
                <a href="#contact">Contact</a>
                <a href="{{ route('appointments.create') }}">Rendez-vous</a>
                <a href="{{ route('login') }}">Admin</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="hero-inner">
                <div>
                    <h1>Votre garage, simple et bien organisé.</h1>
                    <p>Entretien, diagnostic, réparations et suivi client avec une équipe disponible pour vos véhicules.</p>
                    <div class="actions-inline">
                        <a class="btn" href="{{ route('appointments.create') }}">Prendre rendez-vous</a>
                        <a class="btn-muted" href="#services">Voir les services</a>
                    </div>
                </div>
                <div class="public-card">
                    <h2 style="margin-top: 0;">Garage Z</h2>
                    <p class="muted">Service rapide, suivi transparent et interventions planifiées.</p>
                    <div class="grid-auto">
                        <div class="mini-item"><strong>Réparation</strong><span class="muted">Mécanique et entretien</span></div>
                        <div class="mini-item"><strong>Diagnostic</strong><span class="muted">Contrôle complet</span></div>
                        <div class="mini-item"><strong>Dépannage</strong><span class="muted">Assistance rapide</span></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="page">
            <div class="page-header">
                <div>
                    <h2 class="page-title">Nos services</h2>
                    <p class="page-subtitle">Une prise en charge claire pour chaque véhicule.</p>
                </div>
            </div>
            <div class="grid-auto" style="margin-top: 1rem;">
                <article class="public-card">
                    <h3>Réparation mécanique</h3>
                    <p class="muted">Interventions sur les pannes courantes, entretien et pièces d'usure.</p>
                </article>
                <article class="public-card">
                    <h3>Révision générale</h3>
                    <p class="muted">Contrôle sécurité, performance et préparation aux longs trajets.</p>
                </article>
                <article class="public-card">
                    <h3>Suivi atelier</h3>
                    <p class="muted">Planification des rendez-vous et suivi des réparations côté administration.</p>
                </article>
            </div>
        </section>

        <section id="contact" class="page">
            <div class="panel">
                <div class="dashboard-grid">
                    <div>
                        <h2 style="margin-top: 0;">Contact</h2>
                        <p class="muted"><strong>Adresse :</strong> Togo, Ville de Lomé</p>
                        <p class="muted"><strong>Téléphone :</strong> +228 93 40 37 68</p>
                        <p class="muted"><strong>Email :</strong> winidorc1@gmail.com</p>
                    </div>
                    <div>
                        <h2 style="margin-top: 0;">Besoin d'une intervention ?</h2>
                        <p class="muted">Envoyez une demande de rendez-vous avec votre véhicule et le problème rencontré.</p>
                        <a class="btn" href="{{ route('appointments.create') }}">Demander un rendez-vous</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="page">
        <p class="muted">© {{ date('Y') }} Gestion Garage. Tous droits réservés.</p>
    </footer>
</body>
</html>
