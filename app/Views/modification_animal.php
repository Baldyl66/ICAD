<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/modification_animal.css?v=' . time()); ?>">

<div class="container">
    <h1>Modifier l'animal : <?= esc($animal['PRENOM']) ?></h1>

    <form action="<?= base_url('ModificationAnimalController/modifier/' . esc($animal['ICAD'])) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="prenom_animal">Prénom</label>
        <input type="text" id="prenom_animal" name="prenom_animal" value="<?= esc($animal['PRENOM']) ?>" required>

        <label for="age">Âge</label>
        <input type="number" id="age" name="age" value="<?= esc($animal['AGE']) ?>" required>

        <label for="sexe">Sexe</label>
<select id="sexe" name="sexe" class="input-field" required>
    <option value="Mâle" <?= esc($animal['SEXE']) === 'Mâle' ? 'selected' : '' ?>>Mâle</option>
    <option value="Femelle" <?= esc($animal['SEXE']) === 'Femelle' ? 'selected' : '' ?>>Femelle</option>
</select>


        <label for="descriptif">Descriptif</label>
        <textarea id="descriptif" name="descriptif"><?= esc($animal['DESCRIPTIF']) ?></textarea>

        <label for="photo">Photo (optionnelle)</label>
        <input type="file" id="photo" name="photo">

        <div class="animal-photo">
            <?php if (!empty($animal['PHOTO']) && file_exists(FCPATH . 'uploads/' . basename($animal['PHOTO']))): ?>
                <img src="<?= base_url('uploads/' . basename($animal['PHOTO'])) ?>" alt="Photo de <?= esc($animal['PRENOM']) ?>">
            <?php else: ?>
                <span style="color: #888; font-size: 14px;">Aucune image</span>
            <?php endif; ?>
        </div>

        <div class="button-container">
            <button type="submit" class="submit-button">Sauvegarder les modifications</button>
            <a href="<?= base_url('/') ?>" class="cancel-button">Annuler</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
