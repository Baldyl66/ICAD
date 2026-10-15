<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/animal_details.css?v=' . time()); ?>">

<?php
$isPerdu = (isset($animal['STATUE']) && strtolower($animal['STATUE']) === 'perdu');
$photoPath = $animal['PHOTO'] ?? '';
$photoRelativePath = str_replace('C:\\xampp\\htdocs\\icad.local\\icad\\writable\\', '', $photoPath);
$photoFilename = basename($photoRelativePath);
$hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));
?>

<div class="details-page">
    <div class="details-nav-bar">
        <a href="<?= base_url('/') ?>" class="back-link">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Retour au registre
        </a>
    </div>

    <div class="card-passport <?= $isPerdu ? 'passport-lost' : '' ?>">
        <div class="passport-header">
            <div class="passport-photo-side">
                <div class="photo-frame">
                    <?php if ($hasPhoto): ?>
                        <img src="<?= base_url('uploads/' . $photoFilename) ?>" alt="Photo de <?= esc($animal['PRENOM']) ?>" class="animal-cover-img">
                    <?php else: ?>
                        <div class="photo-empty-state">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <span>Aucune photo enregistree</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="passport-title-side">
                <div class="passport-top-row">
                    <span class="passport-category">Fiche d'identification officielle</span>
                    <?php if ($isPerdu): ?>
                        <span class="badge badge-danger">Signalement Perdu</span>
                    <?php else: ?>
                        <span class="badge badge-success">Animal Enregistre / Retrouve</span>
                    <?php endif; ?>
                </div>

                <h1 class="passport-name"><?= esc($animal['PRENOM']) ?></h1>
                <p class="passport-icad">Identifiant unique : <strong><?= esc($animal['ICAD']) ?></strong></p>
            </div>
        </div>

        <div class="passport-body">
            <div class="info-grid">
                <div class="info-card">
                    <span class="info-label">Age</span>
                    <span class="info-value"><?= esc($animal['AGE']) ?> ans</span>
                </div>

                <div class="info-card">
                    <span class="info-label">Sexe</span>
                    <span class="info-value"><?= esc($animal['SEXE']) ?></span>
                </div>

                <div class="info-card">
                    <span class="info-label">Statut national</span>
                    <span class="info-value"><?= ucfirst(esc($animal['STATUE'] ?? 'Retrouve')) ?></span>
                </div>

                <div class="info-card full-span">
                    <span class="info-label">Descriptif et signes particuliers</span>
                    <p class="info-desc">
                        <?= !empty($animal['DESCRIPTIF']) ? nl2br(esc($animal['DESCRIPTIF'])) : 'Aucune description renseignee pour cet animal.' ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="passport-actions">
            <div class="actions-left">
                <a href="<?= base_url('ModificationAnimalController/index/' . $animal['ICAD']) ?>" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                    Modifier le dossier
                </a>
                <a href="<?= base_url('/') ?>" class="btn btn-secondary">
                    Retour
                </a>
            </div>

            <div class="actions-right">
                <form action="<?= base_url('AnimauxController/delete/' . $animal['ICAD']) ?>" method="post" onsubmit="return confirm('Etes-vous sur de vouloir supprimer cet animal ? Cette action est irreversible.')">
                    <button type="submit" class="btn btn-danger">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        Supprimer la fiche
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>