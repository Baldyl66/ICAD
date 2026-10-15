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
            <span class="eyebrow-tag">Registre National Agréé</span>
            <h1 class="page-title">Fichier des identifications animales</h1>
            <p class="page-subtitle">Base centrale des carnivores domestiques identifiés par puce ou tatouage.</p>
        </div>
        <div class="header-actions">
            <a href="<?= base_url('ajouter-animal'); ?>" class="btn btn-primary">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Ajouter un animal
            </a>
            <a href="<?= base_url('ajouter-proprietaire'); ?>" class="btn btn-secondary">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
                Ajouter un propriétaire
            </a>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon-wrap icon-primary">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <div class="kpi-data">
                <span class="kpi-value"><?= $totalAnimaux ?></span>
                <span class="kpi-label">Animaux enregistrés</span>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon-wrap icon-success">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="kpi-data">
                <span class="kpi-value"><?= $totalRetrouves ?></span>
                <span class="kpi-label">Statut retrouvé / normal</span>
            </div>
        </div>

        <div class="kpi-card <?= $totalPerdus > 0 ? 'kpi-alert' : '' ?>">
            <div class="kpi-icon-wrap icon-danger">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <div class="kpi-data">
                <span class="kpi-value"><?= $totalPerdus ?></span>
                <span class="kpi-label">Signalements perdus</span>
            </div>
        </div>
    </div>

    <div class="control-panel">
        <div class="search-box">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="animalSearchBar" class="search-input" placeholder="Rechercher par prénom, puce I-CAD, propriétaire...">
        </div>

        <div class="filter-pills">
            <button type="button" class="pill-btn active" data-filter="all">Tous (<?= $totalAnimaux ?>)</button>
            <button type="button" class="pill-btn" data-filter="retrouve">Retrouvés (<?= $totalRetrouves ?>)</button>
            <button type="button" class="pill-btn" data-filter="perdu">Perdus (<?= $totalPerdus ?>)</button>
        </div>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="data-table" id="animauxTable">
                <thead>
                    <tr>
                        <th>Identité</th>
                        <th>Âge</th>
                        <th>N° I-CAD</th>
                        <th>Sexe</th>
                        <th>Statut</th>
                        <th>Signes & Robe</th>
                        <th>Titulaire</th>
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
                            ?>
                            <tr class="animal-row <?= $isPerdu ? 'row-lost' : '' ?>"
                                data-name="<?= esc(strtolower($animal['PRENOM'] ?? '')) ?>"
                                data-icad="<?= esc(strtolower($animal['ICAD'] ?? '')) ?>"
                                data-status="<?= $statusSlug ?>">
                                <td class="col-identity">
                                    <div class="identity-group">
                                        <div class="avatar-wrap <?= $isPerdu ? 'avatar-lost' : '' ?>">
                                            <?php if ($hasPhoto): ?>
                                                <img src="<?= base_url('uploads/' . $photoFilename) ?>" alt="Photo de <?= esc($animal['PRENOM']) ?>" class="animal-avatar">
                                            <?php else: ?>
                                                <div class="avatar-fallback">
                                                    <span><?= strtoupper(substr(esc($animal['PRENOM'] ?? 'A'), 0, 1)) ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="identity-text">
                                            <span class="animal-name"><?= esc($animal['PRENOM']) ?></span>
                                            <span class="animal-species">Carnivore domestique</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-age"><strong><?= esc($animal['AGE']) ?></strong> ans</td>
                                <td><code class="icad-chip"><?= esc($animal['ICAD']) ?></code></td>
                                <td>
                                    <span class="gender-tag gender-<?= strtolower(esc($animal['SEXE'] ?? '')) ?>">
                                        <?= esc($animal['SEXE']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($isPerdu): ?>
                                        <span class="badge badge-danger">Perdu</span>
                                    <?php else: ?>
                                        <span class="badge badge-success">Retrouvé</span>
                                    <?php endif; ?>
                                </td>
                                <td class="col-desc" title="<?= esc($animal['DESCRIPTIF']) ?>">
                                    <?= esc(mb_strimwidth($animal['DESCRIPTIF'] ?? '', 0, 42, '...')) ?>
                                </td>
                                <td class="col-contact">
                                    <div class="contact-name"><?= esc($animal['prenom_proprietaire'] ?? '') ?> <?= esc($animal['nom_proprietaire'] ?? '') ?></div>
                                    <div class="contact-phone"><?= esc($animal['TELEPHONE'] ?? 'Non renseigné') ?></div>
                                </td>
                                <td class="text-right">
                                    <a href="<?= base_url('animal/' . $animal['ICAD']); ?>" class="action-btn">
                                        Détails
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="9 18 15 12 9 6"></polyline>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="empty-row">
                            <td colspan="8">Aucun animal enregistré dans le registre national.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    (function() {
        const searchInput = document.getElementById('animalSearchBar');
        const pillButtons = document.querySelectorAll('.pill-btn');
        let currentFilter = 'all';

        function applyFilter() {
            const query = searchInput.value.trim().toLowerCase();
            const rows = document.querySelectorAll('#animauxTable tbody tr.animal-row');

            rows.forEach(function(row) {
                const name = row.getAttribute('data-name') || '';
                const icad = row.getAttribute('data-icad') || '';
                const status = row.getAttribute('data-status') || '';

                const matchesQuery = name.includes(query) || icad.includes(query);
                const matchesFilter = (currentFilter === 'all') || (status === currentFilter);

                row.style.display = (matchesQuery && matchesFilter) ? '' : 'none';
            });
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
    })();
</script>

<?= $this->endSection() ?>
