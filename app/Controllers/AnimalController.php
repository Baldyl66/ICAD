<?php

namespace App\Controllers;

use App\Models\AnimalModel;

class AnimalController extends BaseController
{
    // Afficher les détails d'un animal
    public function details($icad)
    {
        $animalModel = new AnimalModel();
        $animal = $animalModel->where('ICAD', $icad)->first();

        // Si l'animal n'est pas trouvé, rediriger vers la liste des animaux
        if (!$animal) {
            return redirect()->to('/animaux');
        }

        // Afficher la vue avec les détails de l'animal
        return view('animal_details', ['animal' => $animal]);
    }
}
