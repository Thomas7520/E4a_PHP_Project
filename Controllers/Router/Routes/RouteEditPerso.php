<?php

namespace Routes;

use Controllers\PersoController;

class RouteEditPerso extends Route
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
        header("Location: index.php?action=add-perso&id=$id");
        exit;
    }

    public function post(array $params = []): void
    {
        // futur traitement du formulaire update
    }

}
