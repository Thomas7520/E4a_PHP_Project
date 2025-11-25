<?php

namespace Routes\Parameter;

use Controllers\ParameterController;
use Routes\Route;

class RouteAddOrigin extends Route
{
    private ParameterController $controller;

    public function __construct(ParameterController $controller)
    {
        parent::__construct('add-origin');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        //$id = $params['id'] ?? null;
        //$this->controller->displayAddParameterForm('origin', $id);
    }

    public function post(array $params = []): void
    {
        $this->controller->addParameter($params, 'origin');
    }
}
