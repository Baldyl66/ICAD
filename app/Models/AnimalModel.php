<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimalModel extends Model
{
    // Configuration principale
    protected $table            = 'animal'; // Nom de la table
    protected $primaryKey       = 'ICAD';   // Clé primaire (corrigée pour correspondre à votre base de données)
    protected $useAutoIncrement = true;     // Auto-incrémentation de l'ID
    protected $returnType       = 'array';  // Les données retournées seront des tableaux
    protected $useSoftDeletes   = false;    // Pas de suppression logique
    protected $protectFields    = true;     // Protection des champs autorisés
    protected $allowedFields    = ['ICAD', 'PRENOM', 'AGE', 'SEXE', 'DESCRIPTIF', 'PHOTO', 'STATUE', 'IDENTIFIANT']; 

    // Options supplémentaires
    protected bool $allowEmptyInserts = false; // Empêche les insertions vides
    protected bool $updateOnlyChanged = true;  // Mets à jour uniquement les champs modifiés

    // Gestion des dates
    protected $useTimestamps = false;     
    protected $dateFormat    = 'datetime'; 

    // Champs de gestion des dates (si timestamps activés)
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];  // Règles de validation (personnalisables)
    protected $validationMessages   = [];  // Messages d'erreur personnalisés
    protected $skipValidation       = false; // Validation activée
    protected $cleanValidationRules = true;  // Nettoyage des règles inutilisées

    // Callbacks (Hooks)
    protected $allowCallbacks = true;  // Autoriser les callbacks
    protected $beforeInsert   = [];    // Callbacks avant insertion
    protected $afterInsert    = [];    // Callbacks après insertion
    protected $beforeUpdate   = [];    // Callbacks avant mise à jour
    protected $afterUpdate    = [];    // Callbacks après mise à jour
    protected $beforeFind     = [];    // Callbacks avant recherche
    protected $afterFind      = [];    // Callbacks après recherche
    protected $beforeDelete   = [];    // Callbacks avant suppression
    protected $afterDelete    = [];    // Callbacks après suppression
}
