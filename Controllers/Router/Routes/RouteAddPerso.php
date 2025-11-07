<?php

namespace Routes;

use Controllers\PersonnageController;

class RouteAddPerso extends Route
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
        $this->controller->displayAddPerso($params);
    }
}
