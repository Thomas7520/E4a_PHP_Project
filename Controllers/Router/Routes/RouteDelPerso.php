<?php

namespace Routes;

use Controllers\PersonnageController;

class RouteDelPerso extends Route
{
    private PersonnageController $controller;

    public function __construct(PersonnageController $controller)
    {
        parent::__construct('delete-perso');
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $id = $this->getParam($params, 'id');

        // supprimer le personnage via le service
        $this->controller->deletePerso($id);


    }

    public function post(array $params = []): void
    {
        // Pas besoin ici
    }

}
