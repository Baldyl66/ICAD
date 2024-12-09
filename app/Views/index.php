<?= $this->extend('layouts/layout') ?>

<?= $this->section('contenu') ?>
<link rel="stylesheet" href="<?= base_url('css/accueil.css?v=' . time()); ?>">

<div class="container">
    <h1>Liste des animaux</h1>
    <div class="button-group">
        <button class="add-animal" onclick="window.location.href='<?= base_url('ajouter-animal'); ?>'">Ajouter un animal</button>
        <button class="add-animal" onclick="window.location.href='<?= base_url('ajouter-proprietaire'); ?>'">Ajouter un propriétaire</button>
    </div>
    <input type="text" class="search-bar" placeholder="Rechercher un animal...">

    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Prénom de l'animal</th>
                <th>Âge</th>
                <th>Numéro I-CAD</th>
                <th>Sexe</th>
                <th>Descriptif</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($animaux)): ?>
                <?php foreach ($animaux as $animal): ?>
                    <tr class="<?= $animal['STATUE'] === 'perdu' ? 'lost' : '' ?>">
                        <td>
                            <?php
                            // Extraire uniquement la partie relative du chemin
                            $photoRelativePath = str_replace('C:\\xampp\\htdocs\\icad.local\\icad\\writable\\', '', $animal['PHOTO']);
                            ?>
                            <?php if (!empty($animal['PHOTO']) && file_exists(FCPATH . 'uploads/' . basename($photoRelativePath))): ?>
                                <img src="<?= base_url('uploads/' . basename($photoRelativePath)) ?>" alt="Photo de <?= esc($animal['PRENOM']) ?>" class="animal-photo">
                            <?php else: ?>
                                <img src="<?= base_url('images/default.png') ?>" alt="Photo par défaut" class="animal-photo">
                            <?php endif; ?>
                        </td>
                        <td><?= esc($animal['PRENOM']) ?></td>
                        <td><?= esc($animal['AGE']) ?> ans</td>
                        <td><?= esc($animal['ICAD']) ?></td>
                        <td><?= esc($animal['SEXE']) ?></td>
                        <td><?= esc($animal['DESCRIPTIF']) ?></td>
                        <td><?= esc($animal['TELEPHONE']) ?></td>
                        <td><?= esc($animal['EMAIL']) ?></td>
                        <td>
                            <!-- Bouton pour afficher les détails -->
                            <a href="<?= base_url('animal/' . $animal['ICAD']); ?>" class="details-button">Voir les détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" style="text-align: center;">Aucun animal trouvé.</td>
                </tr>
            <?php endif; ?>

            <script>
                // Fonction pour filtrer les animaux
                document.querySelector('.search-bar').addEventListener('input', function() {
                    let searchTerm = this.value.toLowerCase(); // Récupère le texte de la barre de recherche
                    let rows = document.querySelectorAll('tbody tr'); // Sélectionne toutes les lignes du tableau

                    // Parcourt chaque ligne pour vérifier le prénom
                    rows.forEach(function(row) {
                        let prenom = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); // Récupère le prénom de l'animal
                        if (prenom.startsWith(searchTerm)) {
                            row.style.display = ''; // Affiche la ligne si le prénom commence par la recherche
                        } else {
                            row.style.display = 'none'; // Cache la ligne si ce n'est pas le cas
                        }
                    });
                });
            </script>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
