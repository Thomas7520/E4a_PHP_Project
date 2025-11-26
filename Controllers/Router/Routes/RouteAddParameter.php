<?php

namespace Routes;

use Controllers\ParameterController;

/**
 * Route class to handle adding a new parameter of any type.
 */
class RouteAddParameter extends ProtectedRoute
{
    private ParameterController $controller;

    /**
     * Constructor.
     *
     * @param ParameterController $controller Controller responsible for parameter operations.
     */
    public function __construct(ParameterController $controller)
    {
        parent::__construct('add-parameter');
        $this->controller = $controller;
    }

    /**
     * Handle GET requests.
     *
     * Displays the main page or form for adding a parameter.
     *
     * @param array $params Optional route parameters.
     */
    public function get(array $params = []): void
    {
        $this->controller->displayAddParameter();
    }

    /**
     * Handle POST requests to start adding a parameter of a specific type.
     *
     * Expects a 'type' field in the request parameters.
     *
     * @param array $params Data from the request.
     * @throws \Exception If the 'type' parameter is missing.
     */
    public function post(array $params = []): void
    {
        $type = $params['type'] ?? null;

        if (!$type) {
            throw new \Exception("Missing parameter type!");
        }

        $this->controller->displayAddParameterForm($type);
    }
}
