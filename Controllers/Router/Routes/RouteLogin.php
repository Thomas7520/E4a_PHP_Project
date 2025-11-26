<?php

namespace Routes;

use Controllers\LoginController;

/**
 * Route class to handle user login.
 */
class RouteLogin extends Route
{
    private LoginController $controller;

    /**
     * Constructor.
     *
     * @param LoginController $controller Controller responsible for login operations.
     */
    public function __construct(LoginController $controller)
    {
        parent::__construct('login');
        $this->controller = $controller;
    }

    /**
     * Handle GET requests.
     *
     * Displays the login form.
     *
     * @param array $params Optional route parameters.
     */
    public function get(array $params = []): void
    {
        $this->controller->loginForm();
    }

    /**
     * Handle POST requests.
     *
     * Processes the login using submitted form data.
     *
     * @param array $params Data from the POST request.
     */
    public function post(array $params = []): void
    {
        $this->controller->loginProcess($_POST);
    }
}
