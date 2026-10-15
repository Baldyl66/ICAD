<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/ajouter-animal.css?v=' . time()); ?>">

<div class="form-wrapper">
    <div class="form-card">
        <div class="card-head">
            <h1 class="card-title">Enregistrer un animal</h1>
            <p class="card-subtitle">Renseignez l'identite du carnivore domestique et son titulaire.</p>
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

        <form action="<?= site_url('/ajouter-animal'); ?>"
              method="POST"
              enctype="multipart/form-data"
              class="app-form">
            <?= csrf_field() ?>

            <!-- Identite et Photo en tete de formulaire -->
            <div class="identity-section">
                <!-- Zone Avatar Photo -->
                <div class="avatar-block">
                    <label class="label-text">Photographie</label>
                    <div class="avatar-box" id="avatarBox">
                        <input type="file" id="photo" name="photo" accept="image/*"
                               class="avatar-native-input" onchange="previewSelectedPhoto(event)">
                        <div class="avatar-empty" id="avatarEmpty">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <span>Ajouter</span>
                        </div>
                        <img id="imagePreviewTarget" src="" alt="Apercu" class="avatar-img" style="display: none;">
                    </div>
                </div>

                <!-- Champs d'identite immediats -->
                <div class="identity-inputs">
                    <div class="form-row-2">
                        <div class="field-box">
                            <label class="label-text" for="prenom_animal">Nom de l'animal</label>
                            <input type="text" id="prenom_animal" name="prenom_animal"
                                   class="ctrl-input" placeholder="Ex: Rio" required autofocus>
                        </div>
                        <div class="field-box">
                            <label class="label-text" for="age">Age (annees)</label>
                            <input type="number" id="age" name="age" min="0" max="35"
                                   class="ctrl-input" placeholder="Ex: 3" required>
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div class="field-box">
                            <label class="label-text" for="sexe">Sexe</label>
                            <select id="sexe" name="sexe" class="ctrl-select" required>
                                <option value="Male">Male</option>
                                <option value="Femelle">Femelle</option>
                            </select>
                        </div>
                        <div class="field-box">
                            <label class="label-text" for="Statue">Statut</label>
                            <select id="Statue" name="Statue" class="ctrl-select" required>
                                <option value="retrouve">Retrouve / Au foyer</option>
                                <option value="perdu">Signale Perdu</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Proprietaire responsable -->
            <div class="field-box">
                <div class="label-row">
                    <label class="label-text" for="identifiant">Proprietaire responsable</label>
                    <a href="<?= base_url('ajouter-proprietaire') ?>" class="quick-add-link">
                        + Creer un nouveau proprietaire
                    </a>
                </div>
                <?php if (!empty($proprietaires)): ?>
                    <select id="identifiant" name="identifiant" class="ctrl-select" required>
                        <option value="" disabled selected>Selectionner le proprietaire dans la liste...</option>
                        <?php foreach ($proprietaires as $p): ?>
                            <option value="<?= esc($p['IDENTIFIANT']) ?>">
                                #<?= esc($p['IDENTIFIANT']) ?> - <?= esc($p['NOM']) ?> <?= esc($p['PRENOM']) ?>
                                (<?= esc($p['TELEPHONE']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <input type="number" id="identifiant" name="identifiant"
                           class="ctrl-input mono" placeholder="Identifiant proprietaire (ex: 1)" required>
                <?php endif; ?>
            </div>

            <!-- Descriptif -->
            <div class="field-box">
                <label class="label-text" for="descriptif">
                    Signes distinctifs & particularites
                    <span class="label-hint">Optionnel</span>
                </label>
                <textarea id="descriptif" name="descriptif" rows="2"
                          class="ctrl-textarea"
                          placeholder="Robe, couleur, pelage, tatouage, puce ou comportement..."></textarea>
            </div>

            <div class="card-actions">
                <a href="<?= base_url('/') ?>" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Enregistrer l'animal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewSelectedPhoto(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(evt) {
            const img = document.getElementById('imagePreviewTarget');
            img.src = evt.target.result;
            img.style.display = 'block';
            document.getElementById('avatarEmpty').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
</script>

<?= $this->endSection() ?>
