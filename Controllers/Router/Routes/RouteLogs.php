<?php

namespace Routes;

use Controllers\LogsController;

/**
 * Route class to display application logs.
 */
class RouteLogs extends ProtectedRoute
{
    private LogsController $controller;

    /**
     * Constructor.
     *
     * @param LogsController $controller Controller responsible for managing logs.
     */
    public function __construct(LogsController $controller)
    {
        parent::__construct('logs');
        $this->controller = $controller;
    }

    /**
     * Handle GET requests.
     *
     * Displays logs, optionally filtered by a 'date' parameter.
     *
     * @param array $params Optional route parameters.
     */
    public function get(array $params = []): void
    {
        $date = $_GET['date'] ?? null;
        $this->controller->index($date);
    }

    /**
     * Handle POST requests.
     *
     * Currently not implemented; log display is handled via GET request.
     *
     * @param array $params Optional route parameters.
     */
    public function post(array $params = []): void
    {
        // Not implemented
    }
}
