<?php

namespace Routes;

use Controllers\MainController;

class RouteIndex extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        parent::__construct('index');
        $this->controller = $controller;
    }

    /**
     * Gère la requête GET
     */
    public function get(array $params = []): void
    {
        $this->controller->index();
    }

    /**
     * Gère la requête POST
     * Pour l'instant, on fait pareil que GET
     */
    public function post(array $params = []): void
    {
        $this->controller->index();
    }
}
