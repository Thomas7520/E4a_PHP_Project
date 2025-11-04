<?php

namespace Controllers;

use League\Plates\Engine;

class MainController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    public function index(): void
    {
        echo $this->templates->render('home', ['gameName' => 'Genshin Impact']);
    }
}
