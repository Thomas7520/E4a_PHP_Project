<?php

namespace Exceptions;

use Controllers\MainController;
use Routes\Route;

class RouteNotFoundException extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        parent::__construct('not-found');
        $this->controller = $controller;
    }

    /**
     * Gère la requête GET
     */
    public function get(array $params = []): void
    {
        $this->controller->notFound();
    }

    /**
     * Gère la requête POST
     * Pour l'instant, on fait pareil que GET
     */
    public function post(array $params = []): void
    {
    }
}
