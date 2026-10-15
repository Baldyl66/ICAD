<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/modification_animal.css?v=' . time()); ?>">

<?php
$isPerdu = (isset($animal['STATUE']) && strtoupper($animal['STATUE']) === 'PERDU');
$photoPath = $animal['PHOTO'] ?? '';
$photoFilename = basename($photoPath);
$hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));
?>

<div class="form-layout">
    <div class="form-nav">
        <a href="<?= base_url('animal/' . $animal['ICAD']) ?>" class="back-link">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Retour a la fiche
        </a>
    </div>

    <div class="form-panel <?= $isPerdu ? 'panel-lost' : '' ?>">
        <div class="panel-header">
            <div class="title-row">
                <h1 class="panel-title">Modifier : <?= esc($animal['PRENOM']) ?></h1>
                <span class="badge <?= $isPerdu ? 'badge-danger' : 'badge-success' ?>">
                    <span class="badge-dot"></span>
                    <?= $isPerdu ? 'Perdu' : 'Retrouve' ?>
                </span>
            </div>
            <p class="panel-desc">Mise a jour des donnees d'identification et du statut de l'animal.</p>
        </div>

        <form action="<?= base_url('ModificationAnimalController/modifier/' . esc($animal['ICAD'])) ?>" method="post" enctype="multipart/form-data" class="app-form">
            <?= csrf_field() ?>

            <div class="media-update-block">
                <div class="current-media">
                    <?php if ($hasPhoto): ?>
                        <img id="editPreview" src="<?= base_url('uploads/' . $photoFilename) ?>" alt="" class="media-img">
                    <?php else: ?>
                        <div id="noPhotoTag" class="media-empty">Sans photo</div>
                        <img id="editPreview" src="" alt="" class="media-img" style="display: none;">
                    <?php endif; ?>
                </div>

                <div class="media-picker">
                    <label class="input-label" for="photo">Changer la photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" class="text-input" onchange="onEditPhotoChange(event)">
                    <small class="hint-text">Laissez vide pour conserver l'image existante.</small>
                </div>
            </div>

            <div class="fields-grid">
                <div class="field-item">
                    <label class="input-label" for="prenom_animal">Nom / Prenom</label>
                    <input type="text" id="prenom_animal" name="prenom_animal" value="<?= esc($animal['PRENOM']) ?>" class="text-input" required>
                </div>

                <div class="field-item">
                    <label class="input-label" for="age">Age (annees)</label>
                    <input type="number" id="age" name="age" min="0" max="40" value="<?= esc($animal['AGE']) ?>" class="text-input" required>
                </div>

                <div class="field-item">
                    <label class="input-label" for="sexe">Sexe</label>
                    <select id="sexe" name="sexe" class="select-input" required>
                        <option value="Mâle" <?= esc($animal['SEXE']) === 'Mâle' ? 'selected' : '' ?>>Male</option>
                        <option value="Femelle" <?= esc($animal['SEXE']) === 'Femelle' ? 'selected' : '' ?>>Femelle</option>
                    </select>
                </div>

                <div class="field-item">
                    <label class="input-label" for="Statue">Statut</label>
                    <select id="Statue" name="Statue" class="select-input" required>
                        <option value="retrouvé" <?= strtoupper(esc($animal['STATUE'])) === 'RETROUVE' ? 'selected' : '' ?>>Retrouve</option>
                        <option value="perdu" <?= strtoupper(esc($animal['STATUE'])) === 'PERDU' ? 'selected' : '' ?>>Perdu</option>
                    </select>
                </div>

                <div class="field-item full-col">
                    <label class="input-label" for="descriptif">Descriptif & particularites</label>
                    <textarea id="descriptif" name="descriptif" rows="3" class="text-input textarea"><?= esc($animal['DESCRIPTIF']) ?></textarea>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                <a href="<?= base_url('animal/' . $animal['ICAD']) ?>" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<script>
    function onEditPhotoChange(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(evt) {
            const preview = document.getElementById('editPreview');
            const noPhoto = document.getElementById('noPhotoTag');
            preview.src = evt.target.result;
            preview.style.display = 'block';
            if (noPhoto) noPhoto.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
</script>

<?= $this->endSection() ?>
