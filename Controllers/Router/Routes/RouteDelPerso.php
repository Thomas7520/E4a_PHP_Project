<?php

namespace Routes;

use Controllers\PersonnageController;

class RouteDelPerso extends Route
{
    private PersonnageController $controller;

    public function __construct(PersonnageController $controller)
    {
        parent::__construct('edit-perso');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $id = $this->getParam($params, 'id');
        // supprimer le personnage via le service
        $this->controller->deletePerso($id);

        // rediriger vers l'index avec message
        header("Location: index.php?message=" . urlencode("Personnage supprimé !"));
        exit;
    }

    public function post(array $params = []): void
    {
        // non utilisé pour l'instant
    }

}
