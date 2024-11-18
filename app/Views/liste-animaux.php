<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Animaux</title>
</head>
<body>
    <h1>Liste des Animaux</h1>

    <!-- Formulaire pour ajouter un animal -->
    <form action="<?= base_url('animaux/ajouter') ?>" method="POST">
        <label for="nom">Nom de l'animal :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="age">Âge de l'animal :</label>
        <input type="number" id="age" name="age" required>

        <label for="identifiant">Identifiant propriétaire :</label>
        <input type="number" id="identifiant" name="identifiant" required>

        <label for="icad">Numéro ICAD de l'animal :</label>
        <input type="number" id="icad" name="icad" required>

        <button type="submit">Ajouter l'animal</button>
    </form>

    <ul>
        <?php foreach ($animal as $animal): ?>
            <li><?= $animal['NOM'] ?> - <?= $animal['AGE'] ?> ans</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
