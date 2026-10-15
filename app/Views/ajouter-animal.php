<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/ajouter-animal.css?v=' . time()); ?>">

<div class="form-layout">
    <div class="form-nav">
        <a href="<?= base_url('/') ?>" class="back-link">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Retour au registre
        </a>
    </div>

    <div class="form-panel">
        <div class="panel-header">
            <h1 class="panel-title">Enregistrer un animal</h1>
            <p class="panel-desc">Saisie des donnees d'identification et rattachement au proprietaire.</p>
        </div>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert-box">
                <span class="alert-title">Erreurs de validation :</span>
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= site_url('/ajouter-animal'); ?>" method="POST" enctype="multipart/form-data" class="app-form">
            <?= csrf_field() ?>

            <div class="form-sections">
                <div class="upload-area">
                    <label class="input-label" for="photo">Photographie</label>
                    <div class="drop-zone">
                        <input type="file" id="photo" name="photo" accept="image/*" class="file-native" onchange="onPhotoSelected(event)">
                        <div class="drop-placeholder" id="dropPlaceholder">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <span>Selectionner une image JPG, PNG ou WEBP</span>
                        </div>
                        <div class="drop-preview" id="dropPreview" style="display: none;">
                            <img id="previewImage" src="" alt="" class="preview-img">
                        </div>
                    </div>
                </div>

                <div class="fields-grid">
                    <div class="field-item">
                        <label class="input-label" for="prenom_animal">Nom / Prenom</label>
                        <input type="text" id="prenom_animal" name="prenom_animal" class="text-input" placeholder="Ex: Rio" required>
                    </div>

                    <div class="field-item">
                        <label class="input-label" for="age">Age (annees)</label>
                        <input type="number" id="age" name="age" min="0" max="40" class="text-input" placeholder="Ex: 4" required>
                    </div>

                    <div class="field-item">
                        <label class="input-label" for="sexe">Sexe</label>
                        <select id="sexe" name="sexe" class="select-input" required>
                            <option value="Mâle">Male</option>
                            <option value="Femelle">Femelle</option>
                        </select>
                    </div>

                    <div class="field-item">
                        <label class="input-label" for="Statue">Statut</label>
                        <select id="Statue" name="Statue" class="select-input" required>
                            <option value="retrouvé">Retrouve / Securise</option>
                            <option value="perdu">Perdu</option>
                        </select>
                    </div>

                    <div class="field-item full-col">
                        <label class="input-label" for="identifiant">Identifiant proprietaire</label>
                        <input type="text" id="identifiant" name="identifiant" class="text-input mono" placeholder="Code titulaire (ex: 1, 2...)" required>
                    </div>

                    <div class="field-item full-col">
                        <label class="input-label" for="descriptif">Descriptif & particularites</label>
                        <textarea id="descriptif" name="descriptif" rows="3" class="text-input textarea" placeholder="Robe, couleur des yeux, tatouage, signes..."></textarea>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Enregistrer la fiche</button>
                <a href="<?= base_url('/') ?>" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<script>
    function onPhotoSelected(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(evt) {
            document.getElementById('previewImage').src = evt.target.result;
            document.getElementById('dropPreview').style.display = 'block';
            document.getElementById('dropPlaceholder').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
</script>

<?= $this->endSection() ?>