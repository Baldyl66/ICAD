<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnimalModel;
use App\Models\ProprietaireModel;

class AjouterAnimalController extends BaseController
{
    public function index(): string
    {
        $animalModel = new AnimalModel();
        $proprietaireModel = new ProprietaireModel();

        $animaux = $animalModel->findAll();
        $proprietaires = $proprietaireModel->findAll();

        foreach ($animaux as &$animal) {
            $animal['proprietaire'] = $proprietaireModel->where('IDENTIFIANT', $animal['IDENTIFIANT'])->first();
        }

        return view('ajouter-animal', [
            'animaux' => $animaux,
            'proprietaires' => $proprietaires,
        ]);
    }

    public function ajouter()
    {
        $animalModel = new AnimalModel();
    
        $prenomAnimal = $this->request->getPost('prenom_animal');
        $age = $this->request->getPost('age');
        $icad = $this->request->getPost('icad');
        $sexe = $this->request->getPost('sexe');
        $descriptif = $this->request->getPost('descriptif');
        $statue = $this->request->getPost('Statue');
        $photo = $this->request->getFile('photo');
        $identifiant = $this->request->getPost('identifiant');
    
        $photoPath = null;
        if ($photo && $photo->isValid()) {
            $newFileName = $photo->getRandomName();
            $photo->move('uploads', $newFileName);
            
            $image = \Config\Services::image()->withFile('uploads/' . $newFileName);
            $image->resize(300, 300, true);
            $image->save('uploads/' . $newFileName);
        
            $photoPath = 'uploads/' . $newFileName;
        }
    
        $animalModel->insert([
            'ICAD' => $icad,
            'PRENOM' => $prenomAnimal,
            'AGE' => $age,
            'SEXE' => $sexe,
            'DESCRIPTIF' => $descriptif,
            'PHOTO' => $photoPath,
            'STATUE' => $statue,
            'IDENTIFIANT' => $identifiant,
        ]);
    
        return redirect()->to('/');
    }
}
