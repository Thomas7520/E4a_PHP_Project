<?php

namespace Routes\Parameter;

use Controllers\ParameterController;
use Routes\ProtectedRoute;
use Routes\Route;

class RouteAddElement extends ProtectedRoute
{
    private ParameterController $controller;

    public function __construct(ParameterController $controller)
    {
        parent::__construct('add-element');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {

    }

    public function post(array $params = []): void
    {
        $this->controller->addParameter($params, 'element');
    }
}
