<?php

namespace Routes;

use Controllers\PersoController;

class RouteDelPerso extends Route
{
    private PersoController $controller;

    public function __construct(PersoController $controller)
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
