<?php

use Helpers\Psr4AutoloaderClass;
use Controllers\Router\Router;

require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace('Helpers', __DIR__ . '/Helpers');
$loader->addNamespace('League\Plates', __DIR__ . '/Vendor/Plates/src');
$loader->addNamespace('Controllers', __DIR__ . '/Controllers');
$loader->addNamespace('Controllers\Router', __DIR__ . '/Controllers/Router');
$loader->addNamespace('Routes', __DIR__ . '/Controllers/Router/Routes');
$loader->addNamespace('Models', __DIR__ . '/Models');
$loader->addNamespace('Services', __DIR__ . '/Services');
$loader->addNamespace('Exceptions', __DIR__ . '/Exceptions');



$router = new Router("action");

$router->routing($_GET, $_POST);