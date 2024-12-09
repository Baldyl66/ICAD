<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnimalModel;
use App\Models\ProprietaireModel;

class AnimauxController extends BaseController
{
    public function index(): string
    {
        $animalModel = new AnimalModel();
        $proprietaireModel = new ProprietaireModel();

        // Récupérer tous les animaux avec leurs propriétaires
        $animaux = $animalModel->select('animal.*, proprietaire.NOM AS nom_proprietaire, proprietaire.PRENOM AS prenom_proprietaire, proprietaire.TELEPHONE, proprietaire.EMAIL')
                               ->join('proprietaire', 'animal.IDENTIFIANT = proprietaire.IDENTIFIANT', 'left')
                               ->findAll();

        // Passer les données à la vue
        return view('index', ['animaux' => $animaux]);

        
    }

    public function delete($icad)
    {
        // Charger le modèle
        $model = new \App\Models\AnimalModel();
    
        // Supprimer l'animal en utilisant la méthode intégrée 'delete'
        $deleted = $model->delete($icad);
    
        if ($deleted) {
            // Rediriger avec un message de succès
            return redirect()->to(base_url('/'))->with('success', 'Animal supprimé avec succès.');
        } else {
            // Rediriger avec un message d'erreur
            return redirect()->to(base_url('/'))->with('error', 'Erreur lors de la suppression de l\'animal.');
        }
    }
    

}
