<?php

namespace Routes;

use Controllers\PersoController;

class RouteAddPerso extends Route
{
    private PersoController $controller;

    public function __construct(PersoController $controller)
    {
        parent::__construct('add-perso');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $this->controller->displayAddPerso($this-> getParam($params, "id"));
    }

    public function post(array $params = []): void
    {
        // futur traitement POST
    }
}
