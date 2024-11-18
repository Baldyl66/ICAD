<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnimalModel;

class AnimauxController extends BaseController
{
    public function index(): string
    {
        $animalModel = new AnimalModel();
        $animal = $animalModel->findAll();

        return view('liste-animaux', ['animal' => $animal]);
    }

    public function ajouter()
    {
        $animalModel = new AnimalModel();

        $nom = $this->request->getPost('nom');
        $age = $this->request->getPost('age');
        $identifiant = $this->request->getPost('identifiant');
        $icad = $this->request->getPost('icad');

        if ($nom && $age && $identifiant && $icad) {
            $animalModel->insert([
                'NOM' => $nom,
                'AGE' => $age,
                'IDENTIFIANT' => $identifiant,
                'ICAD' => $icad,
            ]);
        }

        return redirect()->to('/animaux');
    }
}
