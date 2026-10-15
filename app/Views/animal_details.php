<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/animal_details.css?v=' . time()); ?>">

<?php
$isPerdu = (isset($animal['STATUE']) && strtolower($animal['STATUE']) === 'perdu');
$photoPath = $animal['PHOTO'] ?? '';
$photoFilename = basename(str_replace('C:\\xampp\\htdocs\\icad.local\\icad\\writable\\', '', $photoPath));
$hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));
?>

<div class="details-page">
    <div class="details-nav-bar">
        <a href="<?= base_url('/') ?>" class="back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Retour au registre
        </a>
    </div>

    <div class="profile-card <?= $isPerdu ? 'profile-lost' : '' ?>">
        <div class="profile-top">
            <div class="profile-photo-col">
                <div class="photo-box">
                    <?php if ($hasPhoto): ?>
                        <img src="<?= base_url('uploads/' . $photoFilename) ?>" alt="Photo de <?= esc($animal['PRENOM']) ?>" class="profile-img">
                    <?php else: ?>
                        <div class="photo-fallback">
                            <span><?= strtoupper(substr(esc($animal['PRENOM'] ?? 'A'), 0, 1)) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="profile-header-col">
                <div class="profile-status-row">
                    <span class="badge <?= $isPerdu ? 'badge-danger' : 'badge-success' ?>">
                        <?= $isPerdu ? 'Perdu' : 'Retrouve' ?>
                    </span>
                    <span class="profile-id">Identifiant : <strong><?= esc($animal['ICAD']) ?></strong></span>
                </div>
                <h1 class="profile-title"><?= esc($animal['PRENOM']) ?></h1>
                <p class="profile-subtitle">Carnivore domestique &bull; <?= esc($animal['SEXE']) ?></p>
            </div>
        </div>

        <div class="profile-body">
            <h2 class="section-title">Caracteristiques</h2>
            <div class="specs-grid">
                <div class="spec-item">
                    <span class="spec-label">Age</span>
                    <span class="spec-value"><?= esc($animal['AGE']) ?> ans</span>
                </div>

                <div class="spec-item">
                    <span class="spec-label">Sexe</span>
                    <span class="spec-value"><?= esc($animal['SEXE']) ?></span>
                </div>

                <div class="spec-item">
                    <span class="spec-label">Numero I-CAD</span>
                    <span class="spec-value font-mono"><?= esc($animal['ICAD']) ?></span>
                </div>

                <div class="spec-item">
                    <span class="spec-label">Statut actuel</span>
                    <span class="spec-value"><?= $isPerdu ? 'Signale perdu' : 'Retrouve' ?></span>
                </div>

                <div class="spec-item full-width">
                    <span class="spec-label">Descriptif & particularites</span>
                    <p class="spec-desc">
                        <?= !empty($animal['DESCRIPTIF']) ? nl2br(esc($animal['DESCRIPTIF'])) : 'Aucune information particuliere renseignee.' ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="profile-actions">
            <div class="actions-left">
                <a href="<?= base_url('ModificationAnimalController/index/' . $animal['ICAD']) ?>" class="btn btn-primary">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                    Modifier
                </a>
                <a href="<?= base_url('/') ?>" class="btn btn-secondary">
                    Retour
                </a>
            </div>

            <div class="actions-right">
                <form action="<?= base_url('AnimauxController/delete/' . $animal['ICAD']) ?>" method="post" onsubmit="return confirm('Confirmer la suppression de cette fiche ? Cette action est definitive.')">
                    <button type="submit" class="btn btn-danger">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>