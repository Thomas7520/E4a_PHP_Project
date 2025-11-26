<?php

namespace Routes;

use Controllers\LogsController;

class RouteLogs extends ProtectedRoute
{
    private LogsController $controller;

    public function __construct(LogsController $controller)
    {
        parent::__construct('logs');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $date = $_GET['date'] ?? null;
        $this->controller->index($date);
    }

    public function post(array $params = []): void
    {
    }
}
