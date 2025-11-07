<?php

namespace Controllers;

use League\Plates\Engine;

class PersoController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    public function displayAddPerso(string $id=""): void
    {
        if(empty($id)) {

        } else {

        }

        echo $this->templates->render('add-perso', [
            'title' => 'Ajouter un personnage'
        ]);
    }

    public function displayAddElement(string $id=""): void
    {
        echo $this->templates->render('add-element', [
            'title' => 'Ajouter un élément',
            'id' => $id
        ]);
    }



    public function deletePerso(string $id): void
    {
        $this->service->delete($id);

        header('Location: index.php');
        exit;
    }

}
