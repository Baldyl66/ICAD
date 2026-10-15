<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/animal_details.css?v=' . time()); ?>">

<?php
$isPerdu = (isset($animal['STATUE']) && strtolower($animal['STATUE']) === 'perdu');
$photoPath = $animal['PHOTO'] ?? '';
$photoFilename = basename($photoPath);
$hasPhoto = (!empty($photoPath) && file_exists(FCPATH . 'uploads/' . $photoFilename));
$initiale = strtoupper(substr(esc($animal['PRENOM'] ?? 'A'), 0, 1));

$sexeRaw = mb_strtolower(trim($animal['SEXE'] ?? ''));
$isFemale = (strpos($sexeRaw, 'fem') !== false || $sexeRaw === 'f');
$genderClass = $isFemale ? 'gender-female' : 'gender-male';

$propNom = trim(($animal['prenom_proprietaire'] ?? '') . ' ' . ($animal['nom_proprietaire'] ?? ''));
$propTel = trim($animal['tel_proprietaire'] ?? $animal['TELEPHONE'] ?? '');
$propEmail = trim($animal['email_proprietaire'] ?? $animal['EMAIL'] ?? '');
$propAdresse = trim($animal['adresse_proprietaire'] ?? $animal['ADRESSE'] ?? '');
?>

<div class="profile-page-wrapper">
    <!-- Navigation retour -->
    <div class="profile-top-bar">
        <a href="<?= base_url('/') ?>" class="back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Retour au registre</span>
        </a>
        <div id="toastCopy" class="toast-copy">Identifiant copie dans le presse-papier</div>
    </div>

    <!-- Carte principale du profil -->
    <div class="profile-card-root <?= $isPerdu ? 'panel-lost' : '' ?>">
        <!-- Hero Header -->
        <div class="profile-hero-section">
            <div class="profile-avatar-container">
                <?php if ($hasPhoto): ?>
                    <img src="<?= base_url('uploads/' . $photoFilename) ?>"
                         alt="<?= esc($animal['PRENOM']) ?>" class="profile-photo-img">
                <?php else: ?>
                    <div class="profile-photo-empty">
                        <span class="avatar-letter"><?= $initiale ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="profile-main-meta">
                <div class="profile-status-bar">
                    <?php if ($isPerdu): ?>
                        <span class="badge-status-pill badge-lost">
                            <span class="badge-dot-rose"></span>
                            Signale perdu
                        </span>
                    <?php else: ?>
                        <span class="badge-status-pill badge-found">
                            <span class="badge-dot-emerald"></span>
                            Retrouve
                        </span>
                    <?php endif; ?>

                    <button type="button" class="icad-chip-btn" id="btnCopyIcad"
                            data-copy="<?= esc($animal['ICAD']) ?>"
                            title="Cliquer pour copier l'identifiant">
                        <span class="chip-label">ICAD</span>
                        <span class="chip-number">#<?= esc($animal['ICAD']) ?></span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                    </button>
                </div>

                <h1 class="profile-animal-name"><?= esc($animal['PRENOM']) ?></h1>

                <div class="profile-pills-row">
                    <span class="card-gender-pill <?= $genderClass ?>"><?= esc($animal['SEXE']) ?></span>
                    <span class="card-age-pill"><?= esc($animal['AGE']) ?> ans</span>
                </div>
            </div>

            <div class="profile-actions-box">
                <a href="<?= base_url('ModificationAnimalController/index/' . $animal['ICAD']) ?>"
                   class="btn btn-primary btn-action">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                    <span>Modifier</span>
                </a>
                <form action="<?= base_url('AnimauxController/delete/' . $animal['ICAD']) ?>"
                      method="post" onsubmit="return confirm('Confirmer la suppression definitive de cette fiche ?')">
                    <button type="submit" class="btn btn-del-action" title="Supprimer la fiche">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Corps d'informations -->
        <div class="profile-body-section">
            <!-- Grille des caracteristiques cles -->
            <div class="details-matrix-grid">
                <div class="matrix-tile">
                    <div class="tile-icon icon-blue">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                            <line x1="7" y1="8" x2="17" y2="8"></line>
                            <line x1="7" y1="12" x2="17" y2="12"></line>
                            <line x1="7" y1="16" x2="13" y2="16"></line>
                        </svg>
                    </div>
                    <div class="tile-content">
                        <span class="tile-caption">Numero d'identification</span>
                        <span class="tile-value mono-val">#<?= esc($animal['ICAD']) ?></span>
                    </div>
                </div>

                <div class="matrix-tile">
                    <div class="tile-icon <?= $isFemale ? 'icon-rose' : 'icon-blue' ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M12 8v8"></path>
                            <path d="M8 12h8"></path>
                        </svg>
                    </div>
                    <div class="tile-content">
                        <span class="tile-caption">Sexe</span>
                        <span class="tile-value"><?= esc($animal['SEXE']) ?></span>
                    </div>
                </div>

                <div class="matrix-tile">
                    <div class="tile-icon icon-emerald">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="tile-content">
                        <span class="tile-caption">Age declare</span>
                        <span class="tile-value"><?= esc($animal['AGE']) ?> ans</span>
                    </div>
                </div>

                <div class="matrix-tile">
                    <div class="tile-icon <?= $isPerdu ? 'icon-rose' : 'icon-emerald' ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <div class="tile-content">
                        <span class="tile-caption">Statut actuel</span>
                        <span class="tile-value <?= $isPerdu ? 'text-rose' : 'text-emerald' ?>">
                            <?= $isPerdu ? 'Perdu' : 'Retrouve' ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Signes particuliers -->
            <div class="profile-block-card">
                <div class="block-card-header">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                    <h3 class="block-card-title">Signes particuliers et description</h3>
                </div>
                <div class="block-card-body">
                    <?php if (!empty($animal['DESCRIPTIF'])): ?>
                        <p class="description-text"><?= nl2br(esc($animal['DESCRIPTIF'])) ?></p>
                    <?php else: ?>
                        <p class="description-empty">Aucune particularite ou note specifiee pour cet animal.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Titulaire de l'animal -->
            <div class="profile-block-card">
                <div class="block-card-header">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <h3 class="block-card-title">Titulaire responsable</h3>
                </div>
                <div class="block-card-body">
                    <?php if (!empty($propNom)): ?>
                        <div class="owner-full-card">
                            <div class="owner-identity">
                                <div class="owner-avatar-icon">
                                    <?= strtoupper(substr($propNom, 0, 1)) ?>
                                </div>
                                <div class="owner-identity-names">
                                    <span class="owner-fullname"><?= esc($propNom) ?></span>
                                    <span class="owner-badge-ref">Proprietaire enregistre</span>
                                </div>
                            </div>

                            <div class="owner-contacts-grid">
                                <?php if (!empty($propTel)): ?>
                                    <a href="tel:<?= esc($propTel) ?>" class="contact-item-row"
                                       title="Appeler le proprietaire">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2">
                                            <path d=" M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07
                                             19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11
                                             2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45
                                             2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84
                                             12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                        <span><?= esc($propTel) ?></span>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($propEmail)): ?>
                                    <a href="mailto:<?= esc($propEmail) ?>" class="contact-item-row"
                                       title="Envoyer un email">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2">
                                            <path d=" M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1
                                             0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span><?= esc($propEmail) ?></span>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($propAdresse)): ?>
                                    <div class="contact-item-row">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <span><?= esc($propAdresse) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="description-empty">Aucun titulaire enregistre pour cette fiche d'animal.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        const copyBtn = document.getElementById('btnCopyIcad');
        const toast = document.getElementById('toastCopy');
        if (copyBtn && toast) {
            copyBtn.addEventListener('click', function() {
                const icad = this.getAttribute('data-copy');
                if (!navigator.clipboard) return;
                navigator.clipboard.writeText(icad).then(function() {
                    toast.classList.add('visible');
                    setTimeout(function() { toast.classList.remove('visible'); }, 2000);
                });
            });
        }
    })();
</script>

<?= $this->endSection() ?>
