<?php

namespace Routes;

use Controllers\LoginController;

class RouteLogout extends Route
{
    private LoginController $controller;

    public function __construct(LoginController $controller)
    {
        parent::__construct('logout');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $this->controller->logout();

    }

    public function post(array $params = []): void
    {

    }
}
