<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>I-CAD | Gestionnaire Animalier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png?v=' . time()); ?>">
    <link rel="shortcut icon" href="<?= base_url('favicon.png?v=' . time()); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=' . time()); ?>">
</head>
<body class="app-body">
    <div class="app-layout">
        <!-- Barre laterale de navigation claire -->
        <aside class="sidebar">
            <div class="sidebar-top">
                <div class="sidebar-brand">
                    <img src="<?= base_url('logo.png?v=' . time()); ?>" alt="Logo I-CAD" class="brand-logo-img">
                    <div class="brand-info">
                        <span class="brand-title">I-CAD</span>
                        <span class="brand-desc">Retrouve ton animal</span>
                    </div>
                </div>

                <?php
                $current = current_url();
                $isHome = ($current == base_url('/'));
                $isAddAnimal = (strpos($current, 'ajouter-animal') !== false);
                $isAddOwner = (strpos($current, 'ajouter-proprietaire') !== false);
                ?>

                <nav class="sidebar-menu">
                    <a href="<?= base_url('/') ?>" class="nav-link <?= $isHome ? 'active' : '' ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7" rx="1.5"></rect>
                            <rect x="14" y="3" width="7" height="7" rx="1.5"></rect>
                            <rect x="14" y="14" width="7" height="7" rx="1.5"></rect>
                            <rect x="3" y="14" width="7" height="7" rx="1.5"></rect>
                        </svg>
                        <span>Registre</span>
                    </a>
                    <a href="<?= base_url('ajouter-animal') ?>"
                       class="nav-link <?= $isAddAnimal ? 'active' : '' ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        <span>Nouvel animal</span>
                    </a>
                    <a href="<?= base_url('ajouter-proprietaire') ?>"
                       class="nav-link <?= $isAddOwner ? 'active' : '' ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        <span>Nouveau proprietaire</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Contenu applicatif principal -->
        <div class="main-wrapper">
            <main class="page-content">
                <?= $this->renderSection('contenu') ?>
            </main>
        </div>
    </div>
</body>
</html>
