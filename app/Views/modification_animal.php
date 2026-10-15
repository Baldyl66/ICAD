<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/modification_animal.css?v=' . time()); ?>">

<?php
$isPerdu = (isset($animal['STATUE']) && strtoupper($animal['STATUE']) === 'PERDU');
$photoPath = $animal['PHOTO'] ?? '';
$photoRelativePath = str_replace('C:\\xampp\\htdocs\\icad.local\\icad\\writable\\', '', $photoPath);
$photoFilename = basename($photoRelativePath);
$hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));
?>

<div class="form-page">
    <div class="form-header-bar">
        <a href="<?= base_url('animal/' . $animal['ICAD']) ?>" class="back-link">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Retour a la fiche
        </a>
    </div>

    <div class="form-card <?= $isPerdu ? 'card-lost' : '' ?>">
        <div class="form-title-area">
            <div class="title-with-badge">
                <h1 class="form-title">Modifier l'animal : <?= esc($animal['PRENOM']) ?></h1>
                <?php if ($isPerdu): ?>
                    <span class="badge badge-danger">Statut Perdu</span>
                <?php else: ?>
                    <span class="badge badge-success">Statut Retrouve</span>
                <?php endif; ?>
            </div>
            <p class="form-subtitle">Mise a jour des donnees et du statut d'identification.</p>
        </div>

        <form action="<?= base_url('ModificationAnimalController/modifier/' . esc($animal['ICAD'])) ?>" method="post" enctype="multipart/form-data" class="modern-form">
            <?= csrf_field() ?>

            <div class="photo-edit-section">
                <div class="current-photo-wrap">
                    <?php if ($hasPhoto): ?>
                        <img id="photo-preview" src="<?= base_url('uploads/' . $photoFilename) ?>" alt="Photo de <?= esc($animal['PRENOM']) ?>" class="current-photo">
                    <?php else: ?>
                        <div id="no-photo-badge" class="no-photo-box">Aucune photo</div>
                        <img id="photo-preview" src="" alt="Apercu" class="current-photo" style="display: none;">
                    <?php endif; ?>
                </div>
                <div class="photo-input-wrap">
                    <label class="field-label" for="photo">Remplacer la photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" class="form-control" onchange="previewEditPhoto(event)">
                    <small class="photo-hint">Format JPG, PNG ou WEBP. Laissez vide pour conserver la photo actuelle.</small>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-field">
                    <label class="field-label" for="prenom_animal">Prenom</label>
                    <input type="text" id="prenom_animal" name="prenom_animal" value="<?= esc($animal['PRENOM']) ?>" class="form-control" required>
                </div>

                <div class="form-field">
                    <label class="field-label" for="age">Age (annees)</label>
                    <input type="number" id="age" name="age" min="0" max="40" value="<?= esc($animal['AGE']) ?>" class="form-control" required>
                </div>

                <div class="form-field">
                    <label class="field-label" for="sexe">Sexe</label>
                    <select id="sexe" name="sexe" class="form-control" required>
                        <option value="Mâle" <?= esc($animal['SEXE']) === 'Mâle' ? 'selected' : '' ?>>Male</option>
                        <option value="Femelle" <?= esc($animal['SEXE']) === 'Femelle' ? 'selected' : '' ?>>Femelle</option>
                    </select>
                </div>

                <div class="form-field">
                    <label class="field-label" for="Statue">Statut</label>
                    <select id="Statue" name="Statue" class="form-control" required>
                        <option value="retrouvé" <?= strtoupper(esc($animal['STATUE'])) === 'RETROUVE' ? 'selected' : '' ?>>Retrouve</option>
                        <option value="perdu" <?= strtoupper(esc($animal['STATUE'])) === 'PERDU' ? 'selected' : '' ?>>Perdu</option>
                    </select>
                </div>

                <div class="form-field full-width">
                    <label class="field-label" for="descriptif">Descriptif / Particularites</label>
                    <textarea id="descriptif" name="descriptif" rows="4" class="form-control"><?= esc($animal['DESCRIPTIF']) ?></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary submit-btn">
                    Sauvegarder les modifications
                </button>
                <a href="<?= base_url('animal/' . $animal['ICAD']) ?>" class="btn btn-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function previewEditPhoto(event) {
        const preview = document.getElementById('photo-preview');
        const noPhoto = document.getElementById('no-photo-badge');
        const file = event.target.files[0];

        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (noPhoto) {
                noPhoto.style.display = 'none';
            }
        };
        reader.readAsDataURL(file);
    }
</script>

<?= $this->endSection() ?>
