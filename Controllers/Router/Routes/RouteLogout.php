<?php

namespace Routes;

use Controllers\LoginController;

/**
 * Route class to handle user logout.
 */
class RouteLogout extends Route
{
    private LoginController $controller;

    /**
     * Constructor.
     *
     * @param LoginController $controller Controller responsible for login operations.
     */
    public function __construct(LoginController $controller)
    {
        parent::__construct('logout');
        $this->controller = $controller;
    }

    /**
     * Handle GET requests.
     *
     * Logs the user out.
     *
     * @param array $params Optional route parameters.
     */
    public function get(array $params = []): void
    {
        $this->controller->logout();
    }

    /**
     * Handle POST requests.
     *
     * Currently not implemented; logout is handled via GET request.
     *
     * @param array $params Optional route parameters.
     */
    public function post(array $params = []): void
    {
        // Not implemented
    }
}
