<?php 

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Liste des routes pour les animaux
$routes->get('/liste-animaux', 'AnimauxController::index');
$routes->post('/animaux/ajouter', 'AnimauxController::ajouter'); // Route pour ajouter un animal

// Autres routes
$routes->get('/animal', 'AnimalController::index');
$routes->get('/animal/formulaire', 'AjouterAnimalController::index');
$routes->get('/animal/formulaire/(:num)', 'ModificationAnimalController::index');
