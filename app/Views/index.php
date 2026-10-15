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
    <!-- En-tete de vue -->
    <header class="view-header">
        <div class="view-titles">
            <h1 class="view-heading">Registre des identifications</h1>
            <p class="view-lead">Consultation, signalements et suivi des carnivores domestiques.</p>
        </div>

        <div class="view-actions">
            <button type="button" id="exportBtn" class="btn btn-secondary">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Export CSV
            </button>
            <a href="<?= base_url('ajouter-animal'); ?>" class="btn btn-primary">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Nouvel animal
            </a>
        </div>
    </header>

    <!-- Ruban de resume rapide -->
    <div class="summary-ribbon">
        <div class="ribbon-item">
            <span class="ribbon-num"><?= $totalAnimaux ?></span>
            <span class="ribbon-text">enregistres</span>
        </div>
        <div class="ribbon-sep"></div>
        <div class="ribbon-item">
            <span class="ribbon-num num-green"><?= $totalRetrouves ?></span>
            <span class="ribbon-text">retrouves</span>
        </div>
        <div class="ribbon-sep"></div>
        <div class="ribbon-item">
            <span class="ribbon-num num-red"><?= $totalPerdus ?></span>
            <span class="ribbon-text">recherches</span>
        </div>
    </div>

    <!-- Barre d'outils unifiee -->
    <div class="toolbar">
        <div class="search-input-group">
            <svg class="search-ico" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="quickSearch" class="search-field" placeholder="Rechercher par nom, ICAD ou proprietaire...">
        </div>

        <div class="toolbar-controls">
            <div class="pill-group">
                <button type="button" class="filter-tab active" data-filter="all">Tous</button>
                <button type="button" class="filter-tab" data-filter="retrouve">Retrouves</button>
                <button type="button" class="filter-tab" data-filter="perdu">Perdus</button>
            </div>

            <div class="display-toggle">
                <button type="button" id="btnShowTable" class="toggle-btn active" title="Vue Tableau">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                </button>
                <button type="button" id="btnShowCards" class="toggle-btn" title="Vue Grille">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="meta-status">
        <span id="counterLabel"><?= $totalAnimaux ?> animal(aux) repertorie(s)</span>
        <span id="toastCopy" class="toast-copy">Numero copie</span>
    </div>

    <!-- Conteneur Vue Tableau -->
    <div class="data-surface" id="tableContainer">
        <table class="app-table" id="tableMain">
            <thead>
                <tr>
                    <th>Animal</th>
                    <th>Age</th>
                    <th>Identification</th>
                    <th>Sexe</th>
                    <th>Statut</th>
                    <th>Proprietaire</th>
                    <th class="th-actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($animauxList)): ?>
                    <?php foreach ($animauxList as $animal): ?>
                        <?php
                        $isPerdu = (isset($animal['STATUE']) && strtolower($animal['STATUE']) === 'perdu');
                        $photoPath = $animal['PHOTO'] ?? '';
                        $photoFilename = basename($photoPath);
                        $hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));
                        $statusSlug = $isPerdu ? 'perdu' : 'retrouve';
                        $prop = trim(($animal['prenom_proprietaire'] ?? '') . ' ' . ($animal['nom_proprietaire'] ?? ''));
                        ?>
                        <tr class="table-row <?= $isPerdu ? 'is-lost' : '' ?>"
                            data-name="<?= esc(strtolower($animal['PRENOM'] ?? '')) ?>"
                            data-icad="<?= esc(strtolower($animal['ICAD'] ?? '')) ?>"
                            data-prop="<?= esc(strtolower($prop)) ?>"
                            data-status="<?= $statusSlug ?>">
                            <td>
                                <div class="cell-entity">
                                    <div class="entity-thumb">
                                        <?php if ($hasPhoto): ?>
                                            <img src="<?= base_url('uploads/' . $photoFilename) ?>" alt="" class="thumb-img">
                                        <?php else: ?>
                                            <div class="thumb-fallback">
                                                <?= strtoupper(substr(esc($animal['PRENOM'] ?? 'A'), 0, 1)) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="entity-meta">
                                        <span class="entity-name"><?= esc($animal['PRENOM']) ?></span>
                                        <span class="entity-sub"><?= esc(mb_strimwidth($animal['DESCRIPTIF'] ?? '', 0, 30, '...')) ?></span>
                                    </div>
                                </div>
                            </td>
                            <td><?= esc($animal['AGE']) ?> ans</td>
                            <td>
                                <button type="button" class="badge-chip" data-copy="<?= esc($animal['ICAD']) ?>" title="Copier le numero">
                                    <span><?= esc($animal['ICAD']) ?></span>
                                </button>
                            </td>
                            <td><?= esc($animal['SEXE']) ?></td>
                            <td>
                                <span class="badge <?= $isPerdu ? 'badge-danger' : 'badge-success' ?>">
                                    <span class="badge-dot"></span>
                                    <?= $isPerdu ? 'Perdu' : 'Retrouve' ?>
                                </span>
                            </td>
                            <td>
                                <div class="prop-cell">
                                    <span class="prop-title"><?= esc($prop ?: 'Non renseigne') ?></span>
                                    <small class="prop-sub"><?= esc($animal['TELEPHONE'] ?? '') ?></small>
                                </div>
                            </td>
                            <td class="th-actions">
                                <a href="<?= base_url('animal/' . $animal['ICAD']); ?>" class="row-link">
                                    Consulter
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="cell-empty">Aucune donnee enregistree.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Conteneur Vue Grille -->
    <div class="cards-deck" id="cardsContainer" style="display: none;">
        <?php if (!empty($animauxList)): ?>
            <?php foreach ($animauxList as $animal): ?>
                <?php
                $isPerdu = (isset($animal['STATUE']) && strtolower($animal['STATUE']) === 'perdu');
                $photoPath = $animal['PHOTO'] ?? '';
                $photoFilename = basename($photoPath);
                $hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));
                $statusSlug = $isPerdu ? 'perdu' : 'retrouve';
                $prop = trim(($animal['prenom_proprietaire'] ?? '') . ' ' . ($animal['nom_proprietaire'] ?? ''));
                ?>
                <div class="deck-card <?= $isPerdu ? 'deck-lost' : '' ?>"
                     data-name="<?= esc(strtolower($animal['PRENOM'] ?? '')) ?>"
                     data-icad="<?= esc(strtolower($animal['ICAD'] ?? '')) ?>"
                     data-prop="<?= esc(strtolower($prop)) ?>"
                     data-status="<?= $statusSlug ?>">
                    <div class="deck-media">
                        <?php if ($hasPhoto): ?>
                            <img src="<?= base_url('uploads/' . $photoFilename) ?>" alt="" class="deck-img">
                        <?php else: ?>
                            <div class="deck-empty-photo">
                                <?= strtoupper(substr(esc($animal['PRENOM'] ?? 'A'), 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                        <span class="badge <?= $isPerdu ? 'badge-danger' : 'badge-success' ?> deck-status-badge">
                            <span class="badge-dot"></span>
                            <?= $isPerdu ? 'Perdu' : 'Retrouve' ?>
                        </span>
                    </div>

                    <div class="deck-body">
                        <div class="deck-top">
                            <h3 class="deck-title"><?= esc($animal['PRENOM']) ?></h3>
                            <span class="deck-age"><?= esc($animal['AGE']) ?> ans</span>
                        </div>

                        <div class="deck-specs">
                            <span class="spec-chip">ID: <?= esc($animal['ICAD']) ?></span>
                            <span class="spec-gender"><?= esc($animal['SEXE']) ?></span>
                        </div>

                        <?php if (!empty($animal['DESCRIPTIF'])): ?>
                            <p class="deck-desc"><?= esc(mb_strimwidth($animal['DESCRIPTIF'], 0, 65, '...')) ?></p>
                        <?php endif; ?>

                        <div class="deck-bottom">
                            <span class="deck-owner"><?= esc($prop ?: 'Proprietaire inconnu') ?></span>
                            <a href="<?= base_url('animal/' . $animal['ICAD']); ?>" class="row-link">Fiche</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    (function() {
        const search = document.getElementById('quickSearch');
        const filterTabs = document.querySelectorAll('.filter-tab');
        const counter = document.getElementById('counterLabel');
        const toast = document.getElementById('toastCopy');
        const btnTable = document.getElementById('btnShowTable');
        const btnCards = document.getElementById('btnShowCards');
        const tableBox = document.getElementById('tableContainer');
        const cardsBox = document.getElementById('cardsContainer');
        const exportBtn = document.getElementById('exportBtn');

        let activeFilter = 'all';

        function updateList() {
            const query = search.value.trim().toLowerCase();
            const rows = document.querySelectorAll('#tableMain tbody tr.table-row');
            const cards = document.querySelectorAll('.deck-card');
            let count = 0;

            function matches(item) {
                const name = item.getAttribute('data-name') || '';
                const icad = item.getAttribute('data-icad') || '';
                const prop = item.getAttribute('data-prop') || '';
                const status = item.getAttribute('data-status') || '';

                const qMatch = name.includes(query) || icad.includes(query) || prop.includes(query);
                const fMatch = (activeFilter === 'all') || (status === activeFilter);
                const visible = qMatch && fMatch;

                item.style.display = visible ? '' : 'none';
                return visible;
            }

            rows.forEach(function(row) {
                if (matches(row)) count++;
            });

            cards.forEach(function(card) {
                matches(card);
            });

            counter.textContent = count + ' animal(aux) repertorie(s)';
        }

        search.addEventListener('input', updateList);

        filterTabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                filterTabs.forEach(function(t) { t.classList.remove('active'); });
                this.classList.add('active');
                activeFilter = this.getAttribute('data-filter');
                updateList();
            });
        });

        btnTable.addEventListener('click', function() {
            btnTable.classList.add('active');
            btnCards.classList.remove('active');
            tableBox.style.display = '';
            cardsBox.style.display = 'none';
        });

        btnCards.addEventListener('click', function() {
            btnCards.classList.add('active');
            btnTable.classList.remove('active');
            tableBox.style.display = 'none';
            cardsBox.style.display = 'grid';
        });

        document.querySelectorAll('.badge-chip').forEach(function(chip) {
            chip.addEventListener('click', function() {
                const text = this.getAttribute('data-copy');
                if (!navigator.clipboard) return;
                navigator.clipboard.writeText(text).then(function() {
                    toast.style.opacity = '1';
                    setTimeout(function() { toast.style.opacity = '0'; }, 1800);
                });
            });
        });

        exportBtn.addEventListener('click', function() {
            const rows = document.querySelectorAll('#tableMain tbody tr.table-row');
            let csv = '\uFEFFNumero_ICAD;Prenom;Age;Sexe;Statut;Proprietaire\n';

            rows.forEach(function(row) {
                if (row.style.display !== 'none') {
                    const name = row.querySelector('.entity-name')?.textContent.trim() || '';
                    const age = row.querySelector('td:nth-child(2)')?.textContent.trim() || '';
                    const icad = row.getAttribute('data-icad') || '';
                    const sexe = row.querySelector('td:nth-child(4)')?.textContent.trim() || '';
                    const status = row.getAttribute('data-status') || '';
                    const prop = row.querySelector('.prop-title')?.textContent.trim() || '';
                    csv += `"${icad}";"${name}";"${age}";"${sexe}";"${status}";"${prop}"\n`;
                }
            });

            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'registre_icad_' + new Date().toISOString().slice(0, 10) + '.csv';
            link.click();
        });
    })();
</script>

<?= $this->endSection() ?>
