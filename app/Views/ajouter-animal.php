<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/ajouter-animal.css?v=' . time()); ?>">

<div class="form-page">
    <div class="form-header-bar">
        <a href="<?= base_url('/') ?>" class="back-link">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Retour au registre
        </a>
    </div>

    <div class="form-card">
        <div class="form-title-area">
            <h1 class="form-title">Ajouter un animal</h1>
            <p class="form-subtitle">Enregistrement d'une nouvelle fiche d'identification animale.</p>
        </div>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert-box alert-danger">
                <strong>Des erreurs ont ete detectees :</strong>
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= site_url('/ajouter-animal'); ?>" method="POST" enctype="multipart/form-data" class="modern-form">
            <?= csrf_field() ?>

            <div class="form-grid">
                <div class="form-field full-width">
                    <label class="field-label" for="photo">Photo de l'animal</label>
                    <div class="upload-zone">
                        <input type="file" id="photo" name="photo" accept="image/*" class="file-input" onchange="previewAnimalImage(event)">
                        <div class="upload-prompt">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <span>Cliquez pour choisir un fichier image ou glissez-le ici</span>
                        </div>
                        <div class="preview-wrapper" id="previewWrapper" style="display: none;">
                            <img id="photo-preview" src="" alt="Apercu" class="photo-preview-img">
                        </div>
                    </div>
                </div>

                <div class="form-field">
                    <label class="field-label" for="prenom_animal">Prenom de l'animal</label>
                    <input type="text" id="prenom_animal" name="prenom_animal" class="form-control" placeholder="Ex: Max, Bella..." required>
                </div>

                <div class="form-field">
                    <label class="field-label" for="age">Age (annees)</label>
                    <input type="number" id="age" name="age" min="0" max="40" class="form-control" placeholder="Ex: 3" required>
                </div>

                <div class="form-field">
                    <label class="field-label" for="sexe">Sexe</label>
                    <select id="sexe" name="sexe" class="form-control" required>
                        <option value="Mâle">Male</option>
                        <option value="Femelle">Femelle</option>
                    </select>
                </div>

                <div class="form-field">
                    <label class="field-label" for="Statue">Statut</label>
                    <select id="Statue" name="Statue" class="form-control" required>
                        <option value="retrouvé">Retrouve</option>
                        <option value="perdu">Perdu</option>
                    </select>
                </div>

                <div class="form-field full-width">
                    <label class="field-label" for="identifiant">Identifiant du proprietaire</label>
                    <input type="text" id="identifiant" name="identifiant" class="form-control" placeholder="Code proprietaire (ex: PROP1234)" required>
                </div>

                <div class="form-field full-width">
                    <label class="field-label" for="descriptif">Descriptif ou signes particuliers</label>
                    <textarea id="descriptif" name="descriptif" rows="4" class="form-control" placeholder="Robe, couleur des yeux, tatouage, puce..."></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary submit-btn">
                    Enregistrer l'animal
                </button>
                <a href="<?= base_url('/') ?>" class="btn btn-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function previewAnimalImage(event) {
        const previewWrapper = document.getElementById('previewWrapper');
        const preview = document.getElementById('photo-preview');
        const file = event.target.files[0];

        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewWrapper.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
</script>

<?= $this->endSection() ?>