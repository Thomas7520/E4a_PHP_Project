<?php

namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;
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
        $allPersonnages = $this->service->getDao()->getAll();


        echo $this->templates->render('home', [
            'allPersonnages' => $allPersonnages,
        ]);
    }

    public function displayAddPerso(array $data = []): void
    {
        // Déterminer si c'est un POST
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $id = $data['id'] ?? '';

        if ($method === 'POST') {
            // Récupérer les données du formulaire
            $id = $data['id'] ?? null;
            $name = $data['name'] ?? '';
            $element = $data['element'] ?? '';
            $rarity = (int)($data['rarity'] ?? 1);
            $unitclass = $data['unitclass'] ?? '';
            $origin = $data['origin'] ?? '';
            $urlImg = $data['urlImg'] ?? '';

            if ($id) {
                // Edition
                $perso = PersonnageService::hydrate($this->service->getDao()->getByID($id));
                $perso->setName($name);
                $perso->setElement($element);
                $perso->setRarity($rarity);
                $perso->setUnitclass($unitclass);
                $perso->setOrigin($origin);
                $perso->setUrlImg($urlImg);
                $this->service->getDao()->update($perso);
                $msg = "Personnage mis à jour !";
            } else {
                // Création
                $perso = new \Models\Personnage("randomid", $name, $element, $rarity, $unitclass, $origin, $urlImg);
                $this->service->getDao()->insert($perso);
                $msg = "Personnage ajouté !";
            }

            header("Location: index.php?action=index&msg=" . urlencode($msg));
            exit;
        }

        // GET : afficher le formulaire
        $perso = $id ? PersonnageService::hydrate($this->service->getDao()->getByID($id)) : null;

        echo $perso;

        echo $this->templates->render('add-perso', [
            'title' => $id ? 'Éditer un personnage' : 'Ajouter un personnage',
            'perso' => $perso
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
