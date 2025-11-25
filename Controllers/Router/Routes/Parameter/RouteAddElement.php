<?php

namespace Routes\Parameter;

use Controllers\ParameterController;
use Routes\Route;

class RouteAddElement extends Route
{
    private ParameterController $controller;

    public function __construct(ParameterController $controller)
    {
        parent::__construct('add-element');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        //$id = $params['id'] ?? null;
        //$this->controller->displayAddParameterForm('element', $id);
    }

    public function post(array $params = []): void
    {
        $this->controller->addParameter($params, 'element');
    }
}
