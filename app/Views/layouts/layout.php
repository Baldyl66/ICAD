<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>I-CAD | Gestionnaire Animalier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=' . time()); ?>">
</head>
<body class="app-body">
    <div class="app-layout">
        <!-- Barre laterale de navigation -->
        <aside class="sidebar">
            <div class="sidebar-top">
                <a href="<?= base_url('/') ?>" class="sidebar-brand">
                    <span class="brand-square">IC</span>
                    <div class="brand-info">
                        <span class="brand-title">I-CAD</span>
                        <span class="brand-desc">Animal Registry</span>
                    </div>
                </a>

                <nav class="sidebar-menu">
                    <span class="menu-label">Navigation</span>
                    <a href="<?= base_url('/') ?>" class="nav-link <?= current_url() == base_url('/') ? 'active' : '' ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7" rx="1.5"></rect>
                            <rect x="14" y="3" width="7" height="7" rx="1.5"></rect>
                            <rect x="14" y="14" width="7" height="7" rx="1.5"></rect>
                            <rect x="3" y="14" width="7" height="7" rx="1.5"></rect>
                        </svg>
                        <span>Registre</span>
                    </a>
                    <a href="<?= base_url('ajouter-animal') ?>" class="nav-link <?= strpos(current_url(), 'ajouter-animal') !== false ? 'active' : '' ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        <span>Nouvel animal</span>
                    </a>
                    <a href="<?= base_url('ajouter-proprietaire') ?>" class="nav-link <?= strpos(current_url(), 'ajouter-proprietaire') !== false ? 'active' : '' ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        <span>Nouveau proprietaire</span>
                    </a>
                </nav>
            </div>

            <div class="sidebar-bottom">
                <div class="system-status">
                    <span class="status-dot"></span>
                    <span class="status-text">Base synchronisee</span>
                </div>
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