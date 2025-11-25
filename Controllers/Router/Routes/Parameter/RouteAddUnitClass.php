<?php

namespace Routes\Parameter;

use Controllers\ParameterController;
use Routes\Route;

class RouteAddUnitClass extends Route
{
    private ParameterController $controller;

    public function __construct(ParameterController $controller)
    {
        parent::__construct('add-unitclass');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        //$id = $params['id'] ?? null;
        //$this->controller->displayAddParameterForm('unitclass', $id);
    }

    public function post(array $params = []): void
    {
        $this->controller->addParameter($params, 'unitclass');
    }
}
