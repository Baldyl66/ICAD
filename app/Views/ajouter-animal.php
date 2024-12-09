<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/ajouter-animal.css');?>">
<!-- Formulaire d'ajout d'animal -->
<form action="<?= site_url('/ajouter-animal'); ?>" method="POST" enctype="multipart/form-data" class="form-container">
    <h2>Ajouter un animal</h2>

    <div class="form-group photo-group">
        <label for="photo">Photo de l'animal:</label>
        <input type="file" id="photo" name="photo" accept="image/*" onchange="previewImage(event)">
        <div class="photo-preview">
            <img id="photo-preview" src="" alt="Aperçu de la photo" />
        </div>
    </div>

    <div class="form-group">
        <label for="prenom_animal">Prénom:</label>
        <input type="text" id="prenom_animal" name="prenom_animal" required>
    </div>

    <div class="form-group">
        <label for="age">Âge:</label>
        <input type="number" id="age" name="age" required>
    </div>


    <div class="form-group">
        <label for="sexe">Sexe:</label>
        <select id="sexe" name="sexe" required>
            <option value="Mâle">Mâle</option>
            <option value="Femelle">Femelle</option>
        </select>
    </div>

    <div class="form-group">
        <label for="descriptif">Descriptif:</label>
        <textarea id="descriptif" name="descriptif"></textarea>
    </div>

    <div class="form-group">
        <label for="Statue">Statut:</label>
        <select id="Statue" name="Statue" required>
            <option value="retrouvé">Retrouvé</option>
            <option value="perdu">Perdu</option>
        </select>
    </div>

    <div class="form-group">
        <label for="identifiant">Identifiant propriétaire:</label>
        <input type="text" id="identifiant" name="identifiant" required>
    </div>

    <button type="submit">Ajouter l'animal</button>
</form>

<script>
    function previewImage(event) {
        const photoPreview = document.getElementById('photo-preview');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            photoPreview.src = reader.result;
            photoPreview.style.display = 'block'; // Affiche l'image
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="errors">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <p class="error"><?= esc($error) ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?= $this->endSection() ?>