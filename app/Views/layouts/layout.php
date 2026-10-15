<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>I-CAD | Système d'Identification des Carnivores Domestiques</title>
    <meta name="description" content="Registre national et gestion des identifications animales">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=' . time()); ?>">
</head>
<body class="app-body">
    <header class="app-header">
        <div class="header-inner">
            <div class="brand-block">
                <a href="<?= base_url('/') ?>" class="brand-link">
                    <span class="brand-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </span>
                    <div class="brand-meta">
                        <span class="brand-text">I-CAD <strong>National</strong></span>
                        <span class="brand-subtext">Registre Officiel Agréé</span>
                    </div>
                </a>
            </div>

            <nav class="main-nav">
                <a href="<?= base_url('/') ?>" class="nav-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    </svg>
                    Registre
                </a>
                <a href="<?= base_url('ajouter-animal') ?>" class="nav-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Ajouter un animal
                </a>
                <a href="<?= base_url('ajouter-proprietaire') ?>" class="nav-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                    </svg>
                    Ajouter un propriétaire
                </a>
            </nav>
        </div>
    </header>

    <main class="app-main">
        <?= $this->renderSection('contenu') ?>
    </main>

    <footer class="app-footer">
        <div class="footer-inner">
            <div class="footer-badges">
                <span class="cert-pill">Fichier National Canin &bull; Félin &bull; Furet</span>
                <span class="cert-pill">Agrément Ministère de l'Agriculture</span>
            </div>
            <p class="footer-text">I-CAD &bull; Système d'Information des Carnivores Domestiques</p>
            <p class="footer-copy">&copy; <?= date('Y') ?> Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>