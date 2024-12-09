<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnimalModel;
use App\Models\ProprietaireModel;
use CodeIgniter\Images\ImageManager;

class AjouterAnimalController extends BaseController
{
    public function index(): string
    {
        $animalModel = new AnimalModel();
        $proprietaireModel = new ProprietaireModel();

        // Récupération des données des deux tables
        $animaux = $animalModel->findAll(); // Tous les animaux
        $proprietaires = $proprietaireModel->findAll(); // Tous les propriétaires

        // Associer les propriétaires aux animaux
        foreach ($animaux as &$animal) {
            $animal['proprietaire'] = $proprietaireModel->where('IDENTIFIANT', $animal['IDENTIFIANT'])->first();
        }

        // Envoyer les données à la vue
        return view('ajouter-animal', ['animaux' => $animaux]);
    }

    public function ajouter()
    {
        $animalModel = new AnimalModel();
    
        // Récupération des données du formulaire
        $prenomAnimal = $this->request->getPost('prenom_animal');
        $age = $this->request->getPost('age');
        $icad = $this->request->getPost('icad');
        $sexe = $this->request->getPost('sexe');
        $descriptif = $this->request->getPost('descriptif');
        $statue = $this->request->getPost('Statue');
        $photo = $this->request->getFile('photo'); // Récupérer le fichier photo
        $identifiant = $this->request->getPost('identifiant'); // Identifiant du propriétaire (clé étrangère)
    
        // Gérer le fichier photo (si présent)
        $photoPath = null;
        if ($photo && $photo->isValid()) {
            // Déplacer vers public/uploads
            $newFileName = $photo->getRandomName(); // Génère un nom aléatoire pour éviter les conflits
            $photo->move('uploads', $newFileName); // Déplace dans public/uploads
            
            // Redimensionner l'image après le téléchargement
            $image = \Config\Services::image()
                ->withFile('uploads/' . $newFileName);

            // Redimensionner l'image (par exemple, 300x300 pixels)
            $image->resize(300, 300, true); // Redimensionne à 300x300 pixels

            // Sauvegarder l'image redimensionnée
            $image->save('uploads/' . $newFileName);
        
            // Stocker le chemin relatif dans la base de données
            $photoPath = 'uploads/' . $newFileName;
        }
    
        // Ajouter un animal avec l'IDENTIFIANT du propriétaire
        $animalModel->insert([
            'ICAD' => $icad,
            'PRENOM' => $prenomAnimal,
            'AGE' => $age,
            'SEXE' => $sexe,
            'DESCRIPTIF' => $descriptif,
            'PHOTO' => $photoPath,
            'STATUE' => $statue,
            'IDENTIFIANT' => $identifiant, // Utiliser l'identifiant du propriétaire
        ]);
    
        // Redirection vers l'URL souhaitée après l'ajout
        return redirect()->to('/');
    }
}
