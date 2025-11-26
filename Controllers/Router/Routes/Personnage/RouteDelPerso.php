<?php

namespace Routes\Personnage;

use Controllers\PersonnageController;
use Routes\ProtectedRoute;

/**
 * Route class to handle deleting a character ("personnage").
 */
class RouteDelPerso extends ProtectedRoute
{
    private PersonnageController $controller;

    /**
     * Constructor.
     *
     * @param PersonnageController $controller Controller responsible for character operations.
     */
    public function __construct(PersonnageController $controller)
    {
        parent::__construct('del-perso');
        $this->controller = $controller;
    }

    /**
     * Handle GET requests to delete a character.
     *
     * Expects an 'id' parameter in the route parameters.
     *
     * @param array $params Route parameters containing the character ID.
     * @throws \Exception
     */
    public function get(array $params = []): void
    {
        $id = $this->getParam($params, 'id');
        $this->controller->deletePerso($id);
    }

    /**
     * Handle POST requests.
     *
     * Currently not implemented; deletion is handled via GET request.
     *
     * @param array $params Route parameters (unused).
     */
    public function post(array $params = []): void
    {
        // Not implemented
    }
}
