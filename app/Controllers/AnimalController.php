<?php

namespace App\Controllers;

use App\Models\AnimalModel;

class AnimalController extends BaseController
{
    /**
     * Affiche les details complets d'un animal selectionne
     */
    public function details($icad)
    {
        $animalModel = new AnimalModel();
        $animal = $animalModel->select('animal.*, ' .
                                       'proprietaire.NOM AS nom_proprietaire, ' .
                                       'proprietaire.PRENOM AS prenom_proprietaire, ' .
                                       'proprietaire.TELEPHONE AS tel_proprietaire, ' .
                                       'proprietaire.EMAIL AS email_proprietaire, ' .
                                       'proprietaire.ADRESSE AS adresse_proprietaire')
                              ->join('proprietaire', 'animal.IDENTIFIANT = proprietaire.IDENTIFIANT', 'left')
                              ->where('animal.ICAD', $icad)
                              ->first();

        if (!$animal) {
            return redirect()->to(base_url('/'));
        }

        return view('animal_details', ['animal' => $animal]);
    }
}
