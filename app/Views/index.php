<?= $this->extend('layout') ?>

<?= $this->section('contenu') ?>
<div class="container">
    <button class="add-animal">Ajouter animal</button>
    <input type="text" class="search-bar" placeholder="Barre de recherche">
    <table>
        <tr>
            <td>Prénom animal : ...</td>
            <td>Numéro I-CAD : 00000000</td>
            <td>Téléphone Propriétaire : +33612345678</td>
            <td>Mail Propriétaire : abc@hotmail.fr</td>
        </tr>
        <tr class="lost">
            <td>Prénom animal : ...</td>
            <td>Numéro I-CAD : 00000000</td>
            <td>Téléphone Propriétaire : +33612345678</td>
            <td>Mail Propriétaire : abc@hotmail.fr</td>
        </tr>
    </table>
</div>
<?= $this->endSection() ?>
