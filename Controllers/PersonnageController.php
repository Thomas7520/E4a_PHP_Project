<?php

namespace Controllers;

use League\Plates\Engine;
use Services\PersonnageService;

class PersonnageController
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
        $allPersonnages = $this->service->getAllPersonnages();


        echo $this->templates->render('home', [
            'allPersonnages' => $allPersonnages,
        ]);
    }
}
