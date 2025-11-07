<?php

namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;
use Services\PersonnageService;

class MainController
{
    private Engine $templates;
    private PersonnageService $service;


    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->service = new PersonnageService();
    }

    public function index(): void
    {

        $listPersonnage = PersonnageService::hydrateAll($this->service->getDao()->getAll());

        echo $this->templates->render('home', [
            'listPersonnage' => $listPersonnage,
            'gameName' => 'Genshin Impact'
        ]);
    }

    public function logs(): void
    {
        echo $this->templates->render('logs', [
            'title' => 'Logs du site'
        ]);
    }

    public function login(): void
    {
        echo $this->templates->render('login', [
            'title' => 'Connexion'
        ]);
    }
}
