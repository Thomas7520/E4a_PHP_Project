<?php

namespace Routes\Personnage;

use Controllers\PersonnageController;
use Routes\ProtectedRoute;
use Routes\Route;

class RouteAddPerso extends ProtectedRoute
{
    private PersonnageController $controller;

    public function __construct(PersonnageController $controller)
    {
        parent::__construct('add-perso');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {

        $this->controller->displayAddPerso($params);
    }

    public function post(array $params = []): void
    {
        $this->controller->addPerso($params);
    }
}
