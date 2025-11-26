<?php

namespace Routes\Personnage;

use Controllers\PersonnageController;
use Routes\ProtectedRoute;

/**
 * Route class to handle adding a new "personnage" (character).
 */
class RouteAddPerso extends ProtectedRoute
{
    private PersonnageController $controller;

    /**
     * Constructor.
     *
     * @param PersonnageController $controller Controller responsible for character operations.
     */
    public function __construct(PersonnageController $controller)
    {
        parent::__construct('add-perso');
        $this->controller = $controller;
    }

    /**
     * Handle GET requests.
     *
     * Displays the form for adding a new character.
     *
     * @param array $params Optional route parameters.
     */
    public function get(array $params = []): void
    {
        $this->controller->displayAddPerso($params);
    }

    /**
     * Handle POST requests to add a new character.
     *
     * @param array $params Data from the request to create the character.
     */
    public function post(array $params = []): void
    {
        $this->controller->addPerso($params);
    }
}
