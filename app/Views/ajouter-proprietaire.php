<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/ajouter-proprietaire.css?v=' . time()); ?>">

<div class="form-wrapper">
    <div class="form-card">
        <div class="card-head">
            <span class="id-badge-corner" title="Identifiant attribue automatiquement">
                ID #<?= esc($nouvelIdentifiant) ?>
            </span>
            <h1 class="card-title">Nouveau proprietaire</h1>
            <p class="card-subtitle">Fiche titulaire pour l'attribution des carnivores domestiques.</p>
        </div>

        <form action="<?= site_url('/ajouter-proprietaire'); ?>" method="POST" class="app-form">
            <?= csrf_field() ?>
            <input type="hidden" name="identifiant" value="<?= esc($nouvelIdentifiant) ?>">

            <div class="form-grid-2">
                <!-- Identite -->
                <div class="field-box">
                    <label class="label-text" for="nom">Nom de famille</label>
                    <input type="text" id="nom" name="nom" class="ctrl-input"
                           placeholder="Ex: Dupont" required autofocus>
                </div>

                <div class="field-box">
                    <label class="label-text" for="prenom">Prenom</label>
                    <input type="text" id="prenom" name="prenom" class="ctrl-input"
                           placeholder="Ex: Camille" required>
                </div>

                <!-- Coordonnees -->
                <div class="field-box">
                    <label class="label-text" for="email">Adresse email</label>
                    <input type="email" id="email" name="email" class="ctrl-input"
                           placeholder="Ex: camille.dupont@email.com" required>
                </div>

                <div class="field-box">
                    <label class="label-text" for="telephone">Numero de telephone</label>
                    <input type="tel" id="telephone" name="telephone" class="ctrl-input"
                           placeholder="Ex: 06 12 34 56 78" required>
                </div>

                <!-- Adresse postale pleine largeur -->
                <div class="field-box full-col">
                    <label class="label-text" for="adresse">
                        Adresse postale
                        <span class="label-hint">Voie, code postal et commune</span>
                    </label>
                    <textarea id="adresse" name="adresse" rows="2" class="ctrl-textarea"
                              placeholder="Ex: 14 rue des Lilas, 75011 Paris"></textarea>
                </div>
            </div>

            <div class="card-actions">
                <a href="<?= base_url('/') ?>" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Enregistrer le proprietaire
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
