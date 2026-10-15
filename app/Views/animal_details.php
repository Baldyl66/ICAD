<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/animal_details.css?v=' . time()); ?>">

<?php
$isPerdu = (isset($animal['STATUE']) && strtolower($animal['STATUE']) === 'perdu');
$photoPath = $animal['PHOTO'] ?? '';
$photoFilename = basename($photoPath);
$hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));
?>

<div class="profile-container">
    <div class="profile-breadcrumb">
        <a href="<?= base_url('/') ?>" class="back-link">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Retour au registre
        </a>
    </div>

    <div class="profile-panel <?= $isPerdu ? 'panel-lost' : '' ?>">
        <div class="panel-hero">
            <div class="hero-photo">
                <?php if ($hasPhoto): ?>
                    <img src="<?= base_url('uploads/' . $photoFilename) ?>" alt="" class="hero-img">
                <?php else: ?>
                    <div class="hero-empty">
                        <?= strtoupper(substr(esc($animal['PRENOM'] ?? 'A'), 0, 1)) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="hero-details">
                <div class="hero-tag-row">
                    <span class="badge <?= $isPerdu ? 'badge-danger' : 'badge-success' ?>">
                        <span class="badge-dot"></span>
                        <?= $isPerdu ? 'Signale perdu' : 'Retrouve' ?>
                    </span>
                    <span class="hero-id">ICAD #<?= esc($animal['ICAD']) ?></span>
                </div>

                <h1 class="hero-name"><?= esc($animal['PRENOM']) ?></h1>
                <p class="hero-meta"><?= esc($animal['SEXE']) ?> &bull; <?= esc($animal['AGE']) ?> ans</p>
            </div>

            <div class="hero-actions">
                <a href="<?= base_url('ModificationAnimalController/index/' . $animal['ICAD']) ?>" class="btn btn-primary">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                    Modifier
                </a>
                <form action="<?= base_url('AnimauxController/delete/' . $animal['ICAD']) ?>" method="post" onsubmit="return confirm('Confirmer la suppression de cette fiche ?')">
                    <button type="submit" class="btn btn-secondary btn-del" title="Supprimer">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="panel-content">
            <div class="info-section">
                <h3 class="info-heading">Signes particuliers</h3>
                <p class="info-text">
                    <?= !empty($animal['DESCRIPTIF']) ? nl2br(esc($animal['DESCRIPTIF'])) : 'Aucune description ou particularite specifiee.' ?>
                </p>
            </div>

            <div class="data-matrix">
                <div class="matrix-cell">
                    <span class="cell-label">Numero d'identification</span>
                    <span class="cell-val mono"><?= esc($animal['ICAD']) ?></span>
                </div>
                <div class="matrix-cell">
                    <span class="cell-label">Age</span>
                    <span class="cell-val"><?= esc($animal['AGE']) ?> ans</span>
                </div>
                <div class="matrix-cell">
                    <span class="cell-label">Sexe</span>
                    <span class="cell-val"><?= esc($animal['SEXE']) ?></span>
                </div>
                <div class="matrix-cell">
                    <span class="cell-label">Statut</span>
                    <span class="cell-val"><?= $isPerdu ? 'Perdu' : 'Retrouve' ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>