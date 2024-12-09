<?php 

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Liste des routes pour ajouter les animaux
$routes->get('/ajouter-animal', 'AjouterAnimalController::index');
$routes->post('/ajouter-animal', 'AjouterAnimalController::ajouter'); // Route pour ajouter un animal


// Liste des routes pour ajouter les proprietaires
$routes->get('/ajouter-proprietaire/(:num)', 'AjouterProprietaireController::index/$1'); // Charger le formulaire avec un ID
$routes->get('/ajouter-proprietaire', 'AjouterProprietaireController::index');
$routes->post('/ajouter-proprietaire', 'AjouterProprietaireController::ajouter'); // Route pour ajouter un proprietaire

$routes->get('/', 'AnimauxController::index');

$routes->get('animal/(:segment)', 'AnimalController::details/$1');

$routes->post('AnimauxController/delete/(:num)', 'AnimauxController::delete/$1');




// Autres routes
$routes->get('ModificationAnimalController/index/(:num)', 'ModificationAnimalController::index/$1');
$routes->post('ModificationAnimalController/modifier/(:num)', 'ModificationAnimalController::modifier/$1');
$routes->post('ModificationAnimalController/update/(:num)', 'ModificationAnimalController::update/$1');



