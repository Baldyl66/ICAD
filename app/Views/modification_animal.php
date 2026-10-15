<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/modification_animal.css?v=' . time()); ?>">

<?php
$photoPath = $animal['PHOTO'] ?? '';
$photoFilename = basename($photoPath);
$hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));

$sexeVal = mb_strtolower(trim($animal['SEXE'] ?? ''));
$isFemale = (strpos($sexeVal, 'fem') !== false || $sexeVal === 'f');

$statueVal = mb_strtolower(trim($animal['STATUE'] ?? ''));
$isPerdu = ($statueVal === 'perdu');
?>

<div class="form-wrapper">
    <!-- Navigation retour -->
    <div class="form-nav">
        <a href="<?= base_url('animal/' . $animal['ICAD']) ?>" class="back-link">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Retour a la fiche
        </a>
    </div>

    <div class="form-card <?= $isPerdu ? 'panel-lost' : '' ?>">
        <div class="card-head">
            <div class="head-title-row">
                <h1 class="card-title">Modifier : <?= esc($animal['PRENOM']) ?></h1>
                <?php if ($isPerdu): ?>
                    <span class="badge-status-pill badge-lost">
                        <span class="badge-dot-rose"></span>
                        Signale perdu
                    </span>
                <?php else: ?>
                    <span class="badge-status-pill badge-found">
                        <span class="badge-dot-emerald"></span>
                        Retrouve
                    </span>
                <?php endif; ?>
            </div>
            <p class="card-subtitle">Mise a jour des donnees d'identification et du statut de l'animal.</p>
        </div>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert-box">
                <span class="alert-title">Erreurs de saisie :</span>
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= base_url('ModificationAnimalController/modifier/' . esc($animal['ICAD'])) ?>"
              method="post"
              enctype="multipart/form-data"
              class="app-form">
            <?= csrf_field() ?>

            <!-- Identite et Photo compacte en haut -->
            <div class="identity-section">
                <!-- Zone Avatar Photo -->
                <div class="avatar-block">
                    <label class="label-text">Photographie</label>
                    <div class="avatar-box" id="avatarBox" title="Cliquer pour changer la photo">
                        <input type="file" id="photo" name="photo" accept="image/*"
                               class="avatar-native-input" onchange="previewEditPhoto(event)">
                        
                        <?php if ($hasPhoto): ?>
                            <img id="imagePreviewTarget"
                                 src="<?= base_url('uploads/' . $photoFilename) ?>"
                                 alt="<?= esc($animal['PRENOM']) ?>" class="avatar-img">
                            <div class="avatar-hover-overlay">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2">
                                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8
                                             a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                    <circle cx="12" cy="13" r="4"></circle>
                                </svg>
                                <span>Changer</span>
                            </div>
                        <?php else: ?>
                            <div class="avatar-empty" id="avatarEmpty">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="1.8">
                                    <rect x="3" y="3" width="18" height="16" rx="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                                <span>Ajouter</span>
                            </div>
                            <img id="imagePreviewTarget" src="" alt="Apercu" class="avatar-img" style="display: none;">
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Champs d'identite immediats (2 lignes x 2 colonnes) -->
                <div class="identity-inputs">
                    <div class="form-row-2">
                        <div class="field-box">
                            <label class="label-text" for="prenom_animal">Nom / Prenom</label>
                            <input type="text" id="prenom_animal" name="prenom_animal"
                                   value="<?= esc($animal['PRENOM']) ?>"
                                   class="ctrl-input" required>
                        </div>
                        <div class="field-box">
                            <label class="label-text" for="age">Age (annees)</label>
                            <input type="number" id="age" name="age" min="0" max="40"
                                   value="<?= esc($animal['AGE']) ?>"
                                   class="ctrl-input" required>
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div class="field-box">
                            <label class="label-text" for="sexe">Sexe</label>
                            <select id="sexe" name="sexe" class="ctrl-select" required>
                                <option value="Male" <?= !$isFemale ? 'selected' : '' ?>>Male</option>
                                <option value="Femelle" <?= $isFemale ? 'selected' : '' ?>>Femelle</option>
                            </select>
                        </div>
                        <div class="field-box">
                            <label class="label-text" for="Statue">Statut</label>
                            <select id="Statue" name="Statue" class="ctrl-select" required>
                                <option value="retrouve" <?= !$isPerdu ? 'selected' : '' ?>>Retrouve / Au foyer</option>
                                <option value="perdu" <?= $isPerdu ? 'selected' : '' ?>>Signale Perdu</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Descriptif -->
            <div class="field-box">
                <label class="label-text" for="descriptif">
                    Descriptif & particularites
                    <span class="label-hint">Optionnel</span>
                </label>
                <textarea id="descriptif" name="descriptif" rows="2"
                          class="ctrl-textarea"
                          placeholder="Signes distinctifs, pelage, comportement..."><?=
                              esc($animal['DESCRIPTIF'] ?? '') ?></textarea>
            </div>

            <!-- Boutons d'action : Annuler a gauche, Enregistrer a droite -->
            <div class="card-actions">
                <a href="<?= base_url('animal/' . $animal['ICAD']) ?>" class="btn btn-secondary">
                    Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewEditPhoto(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(evt) {
            const img = document.getElementById('imagePreviewTarget');
            img.src = evt.target.result;
            img.style.display = 'block';
            const empty = document.getElementById('avatarEmpty');
            if (empty) empty.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
</script>

<?= $this->endSection() ?>
