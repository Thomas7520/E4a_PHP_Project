<?php

namespace Routes\Personnage;

use Controllers\PersonnageController;
use Routes\ProtectedRoute;
use Routes\Route;

class RouteDelPerso extends ProtectedRoute
{
    private PersonnageController $controller;

    public function __construct(PersonnageController $controller)
    {
        parent::__construct('del-perso');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $id = $this->getParam($params, 'id');

        $this->controller->deletePerso($id);

    }

    public function post(array $params = []): void
    {

    }

}
