<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/liste-animaux','AnimauxController::index');
$routes->get('/animal','AnimalController::index');
$routes->get('/animal/formulaire','AjouterAnimalController::index');
$routes->get('/animal/formulaire/(:num)','ModificationAnimalController::index');