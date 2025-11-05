<?php

use Helpers\Psr4AutoloaderClass;

require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass();

$loader->register();

$loader->addNamespace('Helpers', __DIR__ . '/Helpers');
$loader->addNamespace('League\Plates', __DIR__ . '/Vendor/Plates/src');
$loader->addNamespace('Controllers', __DIR__ . '/Controllers');
$loader->addNamespace('Models', __DIR__ . '/Models');
$loader->addNamespace('Services', __DIR__ . '/Services');


use Controllers\MainController;

$controller = new MainController();
$controller->index();
