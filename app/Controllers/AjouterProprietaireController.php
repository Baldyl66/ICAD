<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProprietaireModel;

class AjouterProprietaireController extends BaseController
{
    public function index(): string
    {
        $proprietaireModel = new ProprietaireModel();

        // Calculer le prochain IDENTIFIANT
        $dernierProprietaire = $proprietaireModel->orderBy('IDENTIFIANT', 'DESC')->first();
        $nouvelIdentifiant = isset($dernierProprietaire['IDENTIFIANT']) ? $dernierProprietaire['IDENTIFIANT'] + 1 : 1;

        // Passer l'IDENTIFIANT calculé à la vue
        return view('ajouter-proprietaire', ['nouvelIdentifiant' => $nouvelIdentifiant]);
    }

    public function ajouter()
    {
        $proprietaireModel = new ProprietaireModel();

        // Récupération des données du formulaire
        $data = [
            'IDENTIFIANT' => $this->request->getPost('identifiant'),
            'NOM' => $this->request->getPost('nom'),
            'PRENOM' => $this->request->getPost('prenom'),
            'TELEPHONE' => $this->request->getPost('telephone'),
            'EMAIL' => $this->request->getPost('email'),
            'ADRESSE' => $this->request->getPost('adresse'),
        ];

        // Insertion dans la base de données
        $proprietaireModel->insert($data);

        // Redirection après traitement
        return redirect()->to('/');
    }
}
