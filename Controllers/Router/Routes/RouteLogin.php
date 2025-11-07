<?php

namespace Routes;

use Controllers\MainController;

class RouteLogin extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        parent::__construct('login');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $this->controller->login();
    }

    public function post(array $params = []): void
    {
    }
}
