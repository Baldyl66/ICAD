<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>I-CAD | Gestion des identifications animales</title>
    <meta name="description" content="Application de gestion des identifications de carnivores domestiques">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=' . time()); ?>">
</head>
<body class="app-body">
    <header class="app-header">
        <div class="header-inner">
            <div class="brand-block">
                <a href="<?= base_url('/') ?>" class="brand-link">
                    <span class="brand-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M10 5.172C10 3.972 10.972 3 12.172 3c1.2 0 2.172.972 2.172 2.172V7h-4.344V5.172z"/>
                            <rect x="4" y="7" width="16" height="14" rx="3"/>
                            <circle cx="12" cy="13" r="2.5"/>
                        </svg>
                    </span>
                    <div class="brand-meta">
                        <span class="brand-text">I-CAD</span>
                        <span class="brand-subtext">Registre des animaux</span>
                    </div>
                </a>
            </div>

            <nav class="main-nav">
                <a href="<?= base_url('/') ?>" class="nav-item">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    Tableau de bord
                </a>
                <a href="<?= base_url('ajouter-animal') ?>" class="nav-item">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Ajouter un animal
                </a>
                <a href="<?= base_url('ajouter-proprietaire') ?>" class="nav-item">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                    </svg>
                    Ajouter un proprietaire
                </a>
            </nav>
        </div>
    </header>

    <main class="app-main">
        <?= $this->renderSection('contenu') ?>
    </main>

    <footer class="app-footer">
        <div class="footer-inner">
            <p class="footer-text">I-CAD &bull; Application de gestion d'identification animale</p>
            <p class="footer-copy">Projet scolaire realise avec CodeIgniter 4</p>
        </div>
    </footer>
</body>
</html>