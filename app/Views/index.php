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

<div class="page-container">
    <div class="page-header">
        <div class="header-titles">
            <h1 class="page-title">Gestion des animaux</h1>
            <p class="page-subtitle">Suivi du registre d'identification, signalements et coordonnees des proprietaires.</p>
        </div>
        <div class="header-actions">
            <button type="button" id="exportCsvBtn" class="btn btn-secondary">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Exporter (CSV)
            </button>
            <a href="<?= base_url('ajouter-animal'); ?>" class="btn btn-primary">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Ajouter un animal
            </a>
            <a href="<?= base_url('ajouter-proprietaire'); ?>" class="btn btn-secondary">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                </svg>
                Ajouter un proprietaire
            </a>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-data">
                <span class="kpi-value"><?= $totalAnimaux ?></span>
                <span class="kpi-label">Animaux enregistres</span>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-data">
                <span class="kpi-value text-success"><?= $totalRetrouves ?></span>
                <span class="kpi-label">En securite / retrouves</span>
            </div>
        </div>

        <div class="kpi-card <?= $totalPerdus > 0 ? 'kpi-alert' : '' ?>">
            <div class="kpi-data">
                <span class="kpi-value text-danger"><?= $totalPerdus ?></span>
                <span class="kpi-label">Actuellement perdus</span>
            </div>
        </div>
    </div>

    <div class="control-panel">
        <div class="search-box">
            <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="animalSearchBar" class="search-input" placeholder="Rechercher par nom, puce ou proprietaire...">
        </div>

        <div class="panel-right">
            <div class="filter-pills">
                <button type="button" class="pill-btn active" data-filter="all">Tous (<?= $totalAnimaux ?>)</button>
                <button type="button" class="pill-btn" data-filter="retrouve">Retrouves</button>
                <button type="button" class="pill-btn" data-filter="perdu">Perdus</button>
            </div>

            <div class="view-switch">
                <button type="button" id="tableViewBtn" class="switch-btn active" title="Vue Tableau">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                </button>
                <button type="button" id="cardsViewBtn" class="switch-btn" title="Vue Grille">
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

    <div class="results-meta">
        <span id="resultsCounter">Affichage de <?= $totalAnimaux ?> animal(aux)</span>
        <span id="copyFeedback" class="copy-feedback">Numero copie dans le presse-papier</span>
    </div>

    <!-- Mode Tableau -->
    <div class="table-card" id="tableViewSection">
        <div class="table-responsive">
            <table class="data-table" id="animauxTable">
                <thead>
                    <tr>
                        <th>Identite</th>
                        <th>Age</th>
                        <th>Numero I-CAD</th>
                        <th>Sexe</th>
                        <th>Statut</th>
                        <th>Descriptif</th>
                        <th>Proprietaire</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($animauxList)): ?>
                        <?php foreach ($animauxList as $animal): ?>
                            <?php
                            $isPerdu = (isset($animal['STATUE']) && strtolower($animal['STATUE']) === 'perdu');
                            $photoPath = $animal['PHOTO'] ?? '';
                            $photoFilename = basename(str_replace('C:\\xampp\\htdocs\\icad.local\\icad\\writable\\', '', $photoPath));
                            $hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));
                            $statusSlug = $isPerdu ? 'perdu' : 'retrouve';
                            $propName = trim(($animal['prenom_proprietaire'] ?? '') . ' ' . ($animal['nom_proprietaire'] ?? ''));
                            ?>
                            <tr class="animal-row <?= $isPerdu ? 'row-lost' : '' ?>"
                                data-name="<?= esc(strtolower($animal['PRENOM'] ?? '')) ?>"
                                data-icad="<?= esc(strtolower($animal['ICAD'] ?? '')) ?>"
                                data-prop="<?= esc(strtolower($propName)) ?>"
                                data-status="<?= $statusSlug ?>">
                                <td class="col-identity">
                                    <div class="identity-group">
                                        <div class="avatar-wrap <?= $isPerdu ? 'avatar-lost' : '' ?>">
                                            <?php if ($hasPhoto): ?>
                                                <img src="<?= base_url('uploads/' . $photoFilename) ?>" alt="Photo" class="animal-avatar">
                                            <?php else: ?>
                                                <div class="avatar-fallback">
                                                    <?= strtoupper(substr(esc($animal['PRENOM'] ?? 'A'), 0, 1)) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="identity-text">
                                            <span class="animal-name"><?= esc($animal['PRENOM']) ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td><?= esc($animal['AGE']) ?> ans</td>
                                <td>
                                    <button type="button" class="icad-chip-btn" data-copy="<?= esc($animal['ICAD']) ?>" title="Cliquer pour copier">
                                        <code><?= esc($animal['ICAD']) ?></code>
                                    </button>
                                </td>
                                <td><?= esc($animal['SEXE']) ?></td>
                                <td>
                                    <span class="badge <?= $isPerdu ? 'badge-danger' : 'badge-success' ?>">
                                        <?= $isPerdu ? 'Perdu' : 'Retrouve' ?>
                                    </span>
                                </td>
                                <td class="col-desc" title="<?= esc($animal['DESCRIPTIF']) ?>">
                                    <?= esc(mb_strimwidth($animal['DESCRIPTIF'] ?? '', 0, 36, '...')) ?>
                                </td>
                                <td>
                                    <div class="prop-info">
                                        <span class="prop-name"><?= esc($propName ?: 'Non renseigne') ?></span>
                                        <small class="prop-tel"><?= esc($animal['TELEPHONE'] ?? '') ?></small>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <a href="<?= base_url('animal/' . $animal['ICAD']); ?>" class="action-btn">
                                        Voir fiche
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="empty-row">
                            <td colspan="8">Aucun animal enregistre.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mode Cartes / Grille -->
    <div class="cards-grid" id="cardsViewSection" style="display: none;">
        <?php if (!empty($animauxList)): ?>
            <?php foreach ($animauxList as $animal): ?>
                <?php
                $isPerdu = (isset($animal['STATUE']) && strtolower($animal['STATUE']) === 'perdu');
                $photoPath = $animal['PHOTO'] ?? '';
                $photoFilename = basename(str_replace('C:\\xampp\\htdocs\\icad.local\\icad\\writable\\', '', $photoPath));
                $hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));
                $statusSlug = $isPerdu ? 'perdu' : 'retrouve';
                $propName = trim(($animal['prenom_proprietaire'] ?? '') . ' ' . ($animal['nom_proprietaire'] ?? ''));
                ?>
                <div class="animal-card-item <?= $isPerdu ? 'card-lost' : '' ?>"
                     data-name="<?= esc(strtolower($animal['PRENOM'] ?? '')) ?>"
                     data-icad="<?= esc(strtolower($animal['ICAD'] ?? '')) ?>"
                     data-prop="<?= esc(strtolower($propName)) ?>"
                     data-status="<?= $statusSlug ?>">
                    <div class="card-photo-box">
                        <?php if ($hasPhoto): ?>
                            <img src="<?= base_url('uploads/' . $photoFilename) ?>" alt="Photo" class="card-img">
                        <?php else: ?>
                            <div class="card-fallback">
                                <span><?= strtoupper(substr(esc($animal['PRENOM'] ?? 'A'), 0, 1)) ?></span>
                            </div>
                        <?php endif; ?>
                        <span class="card-badge badge <?= $isPerdu ? 'badge-danger' : 'badge-success' ?>">
                            <?= $isPerdu ? 'Perdu' : 'Retrouve' ?>
                        </span>
                    </div>
                    <div class="card-content">
                        <div class="card-header-row">
                            <h3 class="card-name"><?= esc($animal['PRENOM']) ?></h3>
                            <span class="card-age"><?= esc($animal['AGE']) ?> ans</span>
                        </div>
                        <div class="card-chip-row">
                            <span class="card-chip">N° <?= esc($animal['ICAD']) ?></span>
                            <span class="card-gender"><?= esc($animal['SEXE']) ?></span>
                        </div>
                        <?php if (!empty($animal['DESCRIPTIF'])): ?>
                            <p class="card-desc"><?= esc(mb_strimwidth($animal['DESCRIPTIF'], 0, 70, '...')) ?></p>
                        <?php endif; ?>
                        <div class="card-footer">
                            <div class="card-prop">
                                <span><?= esc($propName ?: 'Proprietaire non renseigne') ?></span>
                            </div>
                            <a href="<?= base_url('animal/' . $animal['ICAD']); ?>" class="action-btn">
                                Consulter
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    (function() {
        const searchInput = document.getElementById('animalSearchBar');
        const pillButtons = document.querySelectorAll('.pill-btn');
        const counter = document.getElementById('resultsCounter');
        const copyFeedback = document.getElementById('copyFeedback');
        const tableBtn = document.getElementById('tableViewBtn');
        const cardsBtn = document.getElementById('cardsViewBtn');
        const tableSection = document.getElementById('tableViewSection');
        const cardsSection = document.getElementById('cardsViewSection');
        const exportBtn = document.getElementById('exportCsvBtn');

        let currentFilter = 'all';

        function applyFilter() {
            const query = searchInput.value.trim().toLowerCase();
            const rows = document.querySelectorAll('#animauxTable tbody tr.animal-row');
            const cards = document.querySelectorAll('.animal-card-item');
            let visibleCount = 0;

            function checkItem(el) {
                const name = el.getAttribute('data-name') || '';
                const icad = el.getAttribute('data-icad') || '';
                const prop = el.getAttribute('data-prop') || '';
                const status = el.getAttribute('data-status') || '';

                const matchesQuery = name.includes(query) || icad.includes(query) || prop.includes(query);
                const matchesFilter = (currentFilter === 'all') || (status === currentFilter);
                const show = matchesQuery && matchesFilter;

                el.style.display = show ? '' : 'none';
                return show;
            }

            rows.forEach(function(row) {
                if (checkItem(row)) visibleCount++;
            });

            cards.forEach(function(card) {
                checkItem(card);
            });

            counter.textContent = 'Affichage de ' + visibleCount + ' animal(aux)';
        }

        searchInput.addEventListener('input', applyFilter);

        pillButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                pillButtons.forEach(function(btn) { btn.classList.remove('active'); });
                this.classList.add('active');
                currentFilter = this.getAttribute('data-filter');
                applyFilter();
            });
        });

        tableBtn.addEventListener('click', function() {
            tableBtn.classList.add('active');
            cardsBtn.classList.remove('active');
            tableSection.style.display = '';
            cardsSection.style.display = 'none';
        });

        cardsBtn.addEventListener('click', function() {
            cardsBtn.classList.add('active');
            tableBtn.classList.remove('active');
            tableSection.style.display = 'none';
            cardsSection.style.display = 'grid';
        });

        // Copie du numero I-CAD
        document.querySelectorAll('.icad-chip-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const text = this.getAttribute('data-copy');
                if (!navigator.clipboard) return;
                navigator.clipboard.writeText(text).then(function() {
                    copyFeedback.style.opacity = '1';
                    setTimeout(function() { copyFeedback.style.opacity = '0'; }, 2000);
                });
            });
        });

        // Export CSV direct des resultats visibles
        exportBtn.addEventListener('click', function() {
            const rows = document.querySelectorAll('#animauxTable tbody tr.animal-row');
            let csv = '\uFEFFNumero_ICAD;Prenom;Age;Sexe;Statut;Proprietaire\n';

            rows.forEach(function(row) {
                if (row.style.display !== 'none') {
                    const name = row.querySelector('.animal-name')?.textContent.trim() || '';
                    const age = row.querySelector('td:nth-child(2)')?.textContent.trim() || '';
                    const icad = row.getAttribute('data-icad') || '';
                    const sexe = row.querySelector('td:nth-child(4)')?.textContent.trim() || '';
                    const status = row.getAttribute('data-status') || '';
                    const prop = row.querySelector('.prop-name')?.textContent.trim() || '';
                    csv += `"${icad}";"${name}";"${age}";"${sexe}";"${status}";"${prop}"\n`;
                }
            });

            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'registre_animaux_' + new Date().toISOString().slice(0, 10) + '.csv';
            link.click();
        });
    })();
</script>

<?= $this->endSection() ?>
