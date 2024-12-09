<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/ajouter-proprietaire.css'); ?>">
<!-- Formulaire d'ajout de propriétaire -->
<form action="<?= site_url('/ajouter-proprietaire'); ?>" method="POST" class="form-container">
    <h2>Ajouter un propriétaire</h2>

    <!-- Champ Identifiant généré automatiquement -->
    <div class="form-group">
        <label for="identifiant">Identifiant :</label>
        <input type="text" id="identifiant" name="identifiant" value="<?= $nouvelIdentifiant ?>" readonly>
    </div>

    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
    </div>

    <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
    </div>

    <div class="form-group">
        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" required>
    </div>

    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="adresse">Adresse :</label>
        <textarea id="adresse" name="adresse"></textarea>
    </div>

    <button type="submit">Ajouter le propriétaire</button>
</form>

<?= $this->endSection() ?>
