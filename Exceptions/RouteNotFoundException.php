<?php

namespace Exceptions;

use Controllers\MainController;
use Routes\Route;

/**
 * Route used when a requested action is not found (404 fallback).
 */
class RouteNotFoundException extends Route
{
    private MainController $controller;

    /**
     * Constructor.
     *
     * @param MainController $controller Main controller to render the not-found page.
     */
    public function __construct(MainController $controller)
    {
        parent::__construct('not-found');
        $this->controller = $controller;
    }

    /**
     * Handle GET request by displaying the not-found page.
     *
     * @param array $params Optional GET parameters.
     */
    public function get(array $params = []): void
    {
        $this->controller->notFound();
    }

    /**
     * Handle POST request.
     * Currently does nothing
     *
     * @param array $params Optional POST parameters.
     */
    public function post(array $params = []): void
    {
    }
}
