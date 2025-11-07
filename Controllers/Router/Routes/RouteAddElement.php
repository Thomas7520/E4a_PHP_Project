<?php

namespace Routes;

use Controllers\PersoController;

class RouteAddElement extends Route
{
    private PersoController $controller;

    public function __construct(PersoController $controller)
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
