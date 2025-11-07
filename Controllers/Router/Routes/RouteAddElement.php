<?php

namespace Routes;

use Controllers\PersonnageController;

class RouteAddElement extends Route
{
    private PersonnageController $controller;

    public function __construct(PersonnageController $controller)
    {
        parent::__construct('add-perso-element');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $this->controller->displayAddElement();
    }

    public function post(array $params = []): void
    {
        // futur traitement POST
    }
}
