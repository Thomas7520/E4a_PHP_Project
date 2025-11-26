<?php

namespace Routes\Parameter;

use Controllers\ParameterController;
use Routes\ProtectedRoute;

/**
 * Route class to handle adding a new "unitclass" parameter.
 */
class RouteAddUnitClass extends ProtectedRoute
{
    private ParameterController $controller;

    /**
     * Constructor.
     *
     * @param ParameterController $controller Controller responsible for parameter operations.
     */
    public function __construct(ParameterController $controller)
    {
        parent::__construct('add-unitclass');
        $this->controller = $controller;
    }

    /**
     * Handle GET requests.
     *
     * Currently not implemented; could be used to display a form or retrieve data if needed.
     *
     * @param array $params Optional route parameters.
     */
    public function get(array $params = []): void
    {
        // Not implemented
    }

    /**
     * Handle POST requests to add a new "unitclass" parameter.
     *
     * @param array $params Data from the request to be added as a parameter.
     */
    public function post(array $params = []): void
    {
        $this->controller->addParameter($params, 'unitclass');
    }
}
