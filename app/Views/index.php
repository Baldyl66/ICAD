<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/accueil.css?v=' . time()); ?>">

<?php
$animauxList = $animaux ?? [];
$totalAnimaux = count($animauxList);
$totalPerdus = 0;
$totalRetrouves = 0;

foreach ($animauxList as $item) {
    if (isset($item['STATUE']) && strtolower($item['STATUE']) === 'perdu') {
        $totalPerdus++;
    } else {
        $totalRetrouves++;
    }
}
?>

<div class="view-root">
    <!-- En-tete de vue centre -->
    <header class="registry-header">
        <div class="header-titles-centered">
            <h1 class="header-heading">Registre des identifications</h1>
            <p class="header-lead">Base centrale de suivi et de gestion des carnivores domestiques declares.</p>
        </div>

        <div class="header-action-right">
            <a href="<?= base_url('ajouter-animal'); ?>" class="btn btn-primary">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Nouvel animal
            </a>
        </div>
    </header>

    <!-- Barre unifiee : Recherche et Cartes KPI cliquables -->
    <div class="unified-control-bar">
        <div class="search-box">
            <svg class="search-ico" width="16" height="16" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="quickSearch" class="search-input"
                   placeholder="Rechercher par nom, puce ICAD, proprietaire...">
        </div>

        <div class="kpi-filters-row">
            <button type="button" class="kpi-card-btn active" data-filter="all" title="Filtrer : Tous les animaux">
                <div class="kpi-icon icon-blue">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="3"></rect>
                        <path d="M9 12h6"></path>
                        <path d="M12 9v6"></path>
                    </svg>
                </div>
                <div class="kpi-info">
                    <span class="kpi-label">Tous</span>
                    <span class="kpi-value"><?= $totalAnimaux ?></span>
                </div>
            </button>

            <button type="button" class="kpi-card-btn" data-filter="retrouve" title="Filtrer : Animaux retrouves">
                <div class="kpi-icon icon-emerald">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div class="kpi-info">
                    <span class="kpi-label">Retrouves</span>
                    <span class="kpi-value text-emerald"><?= $totalRetrouves ?></span>
                </div>
            </button>

            <button type="button" class="kpi-card-btn" data-filter="perdu" title="Filtrer : Animaux perdus">
                <div class="kpi-icon icon-rose">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <div class="kpi-info">
                    <span class="kpi-label">Perdus</span>
                    <span class="kpi-value text-rose"><?= $totalPerdus ?></span>
                </div>
            </button>
        </div>
    </div>

    <!-- Statut des resultats -->
    <div class="results-bar">
        <span id="counterLabel" class="counter-text">
            Affichage de <strong><?= $totalAnimaux ?></strong> animal(aux)
        </span>
        
    </div>

    <!-- Grille de blocs d'animaux -->
    <div class="cards-grid" id="cardsContainer">
        <?php if (!empty($animauxList)): ?>
            <?php foreach ($animauxList as $animal): ?>
                <?php
                $isPerdu = (isset($animal['STATUE']) && strtolower($animal['STATUE']) === 'perdu');
                $photoPath = $animal['PHOTO'] ?? '';
                $photoFilename = basename($photoPath);
                $hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));
                $statusSlug = $isPerdu ? 'perdu' : 'retrouve';
                $prop = trim(($animal['prenom_proprietaire'] ?? '') . ' ' .
                             ($animal['nom_proprietaire'] ?? ''));
                $initiale = strtoupper(substr(esc($animal['PRENOM'] ?? 'A'), 0, 1));
                $sexeRaw = mb_strtolower(trim($animal['SEXE'] ?? ''));
                $isFemale = (strpos($sexeRaw, 'fem') !== false || $sexeRaw === 'f');
                $genderClass = $isFemale ? 'gender-female' : 'gender-male';
                ?>
                <a href="<?= base_url('animal/' . $animal['ICAD']); ?>"
                   class="animal-card <?= $isPerdu ? 'card-lost' : '' ?>"
                   data-name="<?= esc(strtolower($animal['PRENOM'] ?? '')) ?>"
                   data-icad="<?= esc(strtolower($animal['ICAD'] ?? '')) ?>"
                   data-prop="<?= esc(strtolower($prop)) ?>"
                   data-status="<?= $statusSlug ?>">
                    
                    <!-- Media de la carte -->
                    <div class="card-media">
                        <?php if ($hasPhoto): ?>
                            <img src="<?= base_url('uploads/' . $photoFilename) ?>"
                                 alt="<?= esc($animal['PRENOM']) ?>" class="card-img">
                        <?php else: ?>
                            <div class="card-placeholder-bg">
                                <div class="avatar-monogram"><?= $initiale ?></div>
                            </div>
                        <?php endif; ?>

                        <!-- Badges Statuts avec la meme DA -->
                        <?php if ($isPerdu): ?>
                            <span class="badge-status-pill badge-lost">
                                <span class="badge-dot-rose"></span>
                                Perdu
                            </span>
                        <?php else: ?>
                            <span class="badge-status-pill badge-found">
                                <span class="badge-dot-emerald"></span>
                                Retrouve
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Contenu de la fiche -->
                    <div class="card-content">
                        <div class="card-header-row">
                            <h3 class="card-animal-name"><?= esc($animal['PRENOM']) ?></h3>
                            <div class="card-pills-group">
                                <span class="card-gender-pill <?= $genderClass ?>"><?= esc($animal['SEXE']) ?></span>
                                <span class="card-age-pill"><?= esc($animal['AGE']) ?> ans</span>
                            </div>
                        </div>

                        <?php if (!empty($animal['DESCRIPTIF'])): ?>
                            <p class="card-desc-txt">
                                <?= esc(mb_strimwidth($animal['DESCRIPTIF'], 0, 85, '...')) ?>
                            </p>
                        <?php endif; ?>

                        <div class="card-footer-box">
                            <div class="owner-inline-row">
                                <span class="owner-tiny-lbl">Titulaire :</span>
                                <span class="owner-main-name"><?= esc($prop ?: 'Non renseigne') ?></span>
                                <?php if (!empty($animal['TELEPHONE'])): ?>
                                    <span class="owner-dot-sep">&bull;</span>
                                    <span class="owner-tel-link"><?= esc($animal['TELEPHONE']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Etat vide si aucun resultat -->
        <div id="noResultsBlock" class="empty-results-box" style="display: none;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.6">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                <line x1="8" y1="11" x2="14" y2="11"></line>
            </svg>
            <h3 class="empty-title">Aucun animal trouve</h3>
            <p class="empty-sub">Modifiez votre recherche ou vos filtres pour voir les fiches.</p>
        </div>
    </div>
</div>

<script>
    (function() {
        const search = document.getElementById('quickSearch');
        const kpiFilters = document.querySelectorAll('.kpi-card-btn');
        const counter = document.getElementById('counterLabel');
                const noResults = document.getElementById('noResultsBlock');

        let activeFilter = 'all';

        function updateList() {
            const query = search.value.trim().toLowerCase();
            const cards = document.querySelectorAll('.animal-card');
            let visibleCount = 0;

            function checkMatch(card) {
                const name = card.getAttribute('data-name') || '';
                const icad = card.getAttribute('data-icad') || '';
                const prop = card.getAttribute('data-prop') || '';
                const status = card.getAttribute('data-status') || '';

                const qMatch = name.includes(query) || icad.includes(query) || prop.includes(query);
                const fMatch = (activeFilter === 'all') || (status === activeFilter);
                const ok = qMatch && fMatch;

                card.style.display = ok ? '' : 'none';
                return ok;
            }

            cards.forEach(function(card) {
                if (checkMatch(card)) visibleCount++;
            });

            if (noResults) {
                noResults.style.display = (visibleCount === 0) ? 'flex' : 'none';
            }

            counter.innerHTML = 'Affichage de <strong>' + visibleCount + '</strong> animal(aux)';
        }

        search.addEventListener('input', updateList);

        kpiFilters.forEach(function(kpiBtn) {
            kpiBtn.addEventListener('click', function() {
                kpiFilters.forEach(function(b) { b.classList.remove('active'); });
                this.classList.add('active');
                activeFilter = this.getAttribute('data-filter');
                updateList();
            });
        });

    })();
</script>

<?= $this->endSection() ?>
