<?php

namespace Routes;

use Controllers\MainController;

/**
 * Route class for the main index page.
 */
class RouteIndex extends Route
{
    private MainController $controller;

    /**
     * Constructor.
     *
     * @param MainController $controller Controller responsible for handling the main page.
     */
    public function __construct(MainController $controller)
    {
        parent::__construct('index');
        $this->controller = $controller;
    }

    /**
     * Handle GET requests.
     *
     * Displays the main index page.
     *
     * @param array $params Optional route parameters.
     */
    public function get(array $params = []): void
    {
        $this->controller->index();
    }

    /**
     * Handle POST requests.
     *
     * Currently behaves the same as GET, displaying the main index page.
     *
     * @param array $params Optional route parameters.
     */
    public function post(array $params = []): void
    {
        $this->controller->index();
    }
}
