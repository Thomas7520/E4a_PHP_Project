<?php

namespace Routes;

use Controllers\MainController;

class RouteLogs extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        parent::__construct('logs');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $this->controller->logs();
    }

    public function post(array $params = []): void
    {
    }
}
