<?php

namespace App\Controllers;

use App\Models\AnimalModel;
use CodeIgniter\Controller;

class ModificationAnimalController extends Controller
{
    public function index($icad)
    {
        $model = new AnimalModel();
        
        // Récupère les détails de l'animal
        $animal = $model->find($icad);

        if (!$animal) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Animal avec ICAD {$icad} introuvable.");
        }

        // Charge la vue avec les informations de l'animal
        return view('modification_animal', ['animal' => $animal]);
    }

    public function update($icad)
    {
        $model = new AnimalModel();

        // Validation des données envoyées
        $validation = \Config\Services::validation();
        $validation->setRules([
            'prenom' => 'required|min_length[3]',
            'age' => 'required|is_natural_no_zero',
            'sexe' => 'required',
            'descriptif' => 'required'
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Met à jour les informations de l'animal
        $data = [
            'PRENOM' => $this->request->getPost('prenom'),
            'AGE' => $this->request->getPost('age'),
            'SEXE' => $this->request->getPost('sexe'),
            'DESCRIPTIF' => $this->request->getPost('descriptif'),
            'STATUE' => $this->request->getPost('Statue')
        ];

        $model->update($icad, $data);

        return redirect()->to(base_url('/animal/' . $icad))->with('success', 'Animal mis à jour avec succès');
    }

    public function modifier($icad)
    {
        // Charger le modèle AnimalModel
        $animalModel = new AnimalModel();

        // Récupérer les données soumises par le formulaire
        $data = [
            'PRENOM' => $this->request->getPost('prenom_animal'),
            'AGE' => $this->request->getPost('age'),
            'SEXE' => $this->request->getPost('sexe'),
            'DESCRIPTIF' => $this->request->getPost('descriptif'),
            'STATUE' => $this->request->getPost('Statue')
        ];

        // Si une photo est téléchargée, on la traite
        if ($this->request->getFile('photo')->isValid()) {
            $photo = $this->request->getFile('photo');
            $newName = $photo->getRandomName();
            $photo->move(FCPATH . 'uploads/', $newName);
            $data['PHOTO'] = 'uploads/' . $newName;
        }

        // Mettre à jour les données dans la base de données
        $animalModel->update($icad, $data);

        // Rediriger vers la page d'accueil ou vers une page de confirmation
        return redirect()->to('/')->with('success', 'Animal modifié avec succès');
    }
}
