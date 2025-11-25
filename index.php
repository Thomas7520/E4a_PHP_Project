<?php

use Helpers\Psr4AutoloaderClass;

require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';
require_once __DIR__ . '/Helpers/Toast.php';
require_once __DIR__ . '/Controllers/Router/Router.php';


$loader = new Psr4AutoloaderClass();

$loader->register();

$loader->addNamespace('Helpers', __DIR__ . '/Helpers');
$loader->addNamespace('League\Plates', __DIR__ . '/Vendor/Plates/src');
$loader->addNamespace('Controllers', __DIR__ . '/Controllers');
$loader->addNamespace('Router', __DIR__ . '/Controllers/Router');
$loader->addNamespace('Routes', __DIR__ . '/Controllers/Router/Routes');
$loader->addNamespace('Models', __DIR__ . '/Models');
$loader->addNamespace('Services', __DIR__ . '/Services');


use Routes\Router;

$router = new Router();
$router->routing($_GET, $_POST);