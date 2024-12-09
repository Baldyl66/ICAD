<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/animal_details.css?v=' . time()); ?>">
<div class="container">
    <h1>Détails de l'animal : <?= esc($animal['PRENOM']) ?></h1>
    <div class="animal-details">
        <div class="animal-photo">
            <?php if (!empty($animal['PHOTO']) && file_exists(FCPATH . 'uploads/' . basename($animal['PHOTO']))): ?>
                <img src="<?= base_url('uploads/' . basename($animal['PHOTO'])) ?>" alt="Photo de <?= esc($animal['PRENOM']) ?>">
            <?php else: ?>
                <span style="color: #888; font-size: 14px;">Aucune image</span>
            <?php endif; ?>
        </div>

        <div class="animal-info">
            <p><strong>Prénom :</strong> <?= esc($animal['PRENOM']) ?></p>
            <p><strong>Âge :</strong> <?= esc($animal['AGE']) ?> ans</p>
            <p><strong>Numéro I-CAD :</strong> <?= esc($animal['ICAD']) ?></p>
            <p><strong>Sexe :</strong> <?= esc($animal['SEXE']) ?></p>
            <p><strong>Descriptif :</strong> <?= esc($animal['DESCRIPTIF']) ?></p>
        </div>
    </div>

    <div class="button-container">
        <!-- Bouton de retour -->
        <a href="<?= base_url('/') ?>" class="back-button">Retour à la liste</a>

        <!-- Bouton Supprimer -->
        <form action="<?= base_url('AnimauxController/delete/' . $animal['ICAD']) ?>" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ? Cette action est irréversible.')">
            <button type="submit" class="delete-button">Supprimer</button>
        </form>
        <!-- Bouton Modifier -->
    <a href="<?= base_url('ModificationAnimalController/index/' . $animal['ICAD']) ?>" class="edit-button">Modifier</a>
    </div>
</div>
<?= $this->endSection() ?>