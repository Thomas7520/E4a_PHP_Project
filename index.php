<?php

use Controllers\Router\Router;
use Helpers\Psr4AutoloaderClass;

require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';
require_once __DIR__ . '/Helpers/Toast.php';

session_start();

$loader = new Psr4AutoloaderClass();
$loader->register();

// Helpers
$loader->addNamespace('Helpers', __DIR__ . '/Helpers');

// Plates
$loader->addNamespace('League\Plates', __DIR__ . '/Vendor/Plates/src');

// Controllers
$loader->addNamespace('Controllers', __DIR__ . '/Controllers');
$loader->addNamespace('Routes', __DIR__ . '/Controllers/Router/Routes');
$loader->addNamespace('Routes\Parameter', __DIR__ . '/Controllers/Router/Routes/Parameter');
$loader->addNamespace('Routes\Personnage', __DIR__ . '/Controllers/Router/Routes/Personnage');

// Models
$loader->addNamespace('Models', __DIR__ . '/Models');
$loader->addNamespace('Models\Personnage', __DIR__ . '/Models/Personnage');
$loader->addNamespace('Models\Parameter', __DIR__ . '/Models/Parameter');
$loader->addNamespace('Models\User', __DIR__ . '/Models/User');

$loader->addNamespace('Models\Parameter\Element', __DIR__ . '/Models/Parameter/Element');
$loader->addNamespace('Models\Parameter\Origin', __DIR__ . '/Models/Parameter/Origin');
$loader->addNamespace('Models\Parameter\UnitClass', __DIR__ . '/Models/Parameter/UnitClass');


// Services
$loader->addNamespace('Services', __DIR__ . '/Services');

// Exceptions
$loader->addNamespace('Exceptions', __DIR__ . '/Exceptions');

// Lancer le router
$router = new Router("action");
$router->routing($_GET, $_POST);

// Pour ajouter des loggins dans la bdd

// \Services\AuthService::register("thomas", "test");