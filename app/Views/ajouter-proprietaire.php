<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/ajouter-proprietaire.css?v=' . time()); ?>">

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
            <h1 class="form-title">Ajouter un proprietaire</h1>
            <p class="form-subtitle">Creation d'une fiche titulaire pour lier des carnivores domestiques.</p>
        </div>

        <form action="<?= site_url('/ajouter-proprietaire'); ?>" method="POST" class="modern-form">
            <?= csrf_field() ?>

            <div class="form-grid">
                <div class="form-field full-width">
                    <label class="field-label" for="identifiant">
                        Identifiant du proprietaire
                        <span class="badge-auto">Genere automatiquement</span>
                    </label>
                    <input type="text" id="identifiant" name="identifiant" value="<?= esc($nouvelIdentifiant) ?>" class="form-control readonly-control" readonly>
                </div>

                <div class="form-field">
                    <label class="field-label" for="nom">Nom de famille</label>
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Ex: Dupont" required>
                </div>

                <div class="form-field">
                    <label class="field-label" for="prenom">Prenom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Ex: Jean" required>
                </div>

                <div class="form-field">
                    <label class="field-label" for="telephone">Numero de telephone</label>
                    <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="Ex: 06 12 34 56 78" required>
                </div>

                <div class="form-field">
                    <label class="field-label" for="email">Adresse email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Ex: jean.dupont@email.com" required>
                </div>

                <div class="form-field full-width">
                    <label class="field-label" for="adresse">Adresse postale complete</label>
                    <textarea id="adresse" name="adresse" rows="3" class="form-control" placeholder="Numero, rue, code postal, ville..."></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary submit-btn">
                    Enregistrer le proprietaire
                </button>
                <a href="<?= base_url('/') ?>" class="btn btn-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
