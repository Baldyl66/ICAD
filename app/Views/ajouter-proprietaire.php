<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/ajouter-proprietaire.css?v=' . time()); ?>">

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
            <h1 class="panel-title">Nouveau proprietaire</h1>
            <p class="panel-desc">Creation d'une fiche titulaire pour l'attribution des carnivores domestiques.</p>
        </div>

        <form action="<?= site_url('/ajouter-proprietaire'); ?>" method="POST" class="app-form">
            <?= csrf_field() ?>

            <div class="fields-grid">
                <div class="field-item full-col">
                    <label class="input-label" for="identifiant">
                        Identifiant attribue
                        <span class="auto-tag">Auto-genere</span>
                    </label>
                    <input type="text" id="identifiant" name="identifiant" value="<?= esc($nouvelIdentifiant) ?>" class="text-input mono readonly" readonly>
                </div>

                <div class="field-item">
                    <label class="input-label" for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" class="text-input" placeholder="Ex: Martin" required>
                </div>

                <div class="field-item">
                    <label class="input-label" for="prenom">Prenom</label>
                    <input type="text" id="prenom" name="prenom" class="text-input" placeholder="Ex: Sophie" required>
                </div>

                <div class="field-item">
                    <label class="input-label" for="telephone">Telephone</label>
                    <input type="tel" id="telephone" name="telephone" class="text-input" placeholder="Ex: 06 12 34 56 78" required>
                </div>

                <div class="field-item">
                    <label class="input-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="text-input" placeholder="Ex: sophie.martin@email.com" required>
                </div>

                <div class="field-item full-col">
                    <label class="input-label" for="adresse">Adresse postale</label>
                    <textarea id="adresse" name="adresse" rows="3" class="text-input textarea" placeholder="Voie, code postal, commune..."></textarea>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Creer le proprietaire</button>
                <a href="<?= base_url('/') ?>" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
