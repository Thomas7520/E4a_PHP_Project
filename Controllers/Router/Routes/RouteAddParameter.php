<?php

namespace Routes;

use Controllers\ParameterController;

class RouteAddParameter extends Route
{
    private ParameterController $controller;

    public function __construct(ParameterController $controller)
    {
        parent::__construct('add-parameter');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $this->controller->displayAddParameter();
    }

    public function post(array $params = []): void
    {
        // Récupérer le type depuis le formulaire
        $type = $params['type'] ?? null;

        if (!$type) {
            throw new \Exception("Type de paramètre manquant !");
        }

        $this->controller->displayAddParameterForm($type);
    }
}
