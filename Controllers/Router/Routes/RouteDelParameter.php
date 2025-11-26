<?php

namespace Routes;

use Controllers\ParameterController;

class RouteDelParameter extends ProtectedRoute
{
    private ParameterController $controller;

    public function __construct(ParameterController $controller)
    {
        parent::__construct('del-parameter');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
       // $this->controller->displayAddParameter();
    }

    public function post(array $params = []): void
    {
        //$this->controller->handleAddParameter($_POST);
    }
}
