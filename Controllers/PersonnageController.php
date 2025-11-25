<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Personnage;
use Models\PersonnageDAO;
use Services\PersonnageService;

class PersonnageController
{
    private Engine $templates;

    private PersonnageService $service;

    private MainController $mainController;

    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->service = new PersonnageService();


    }



    public function displayAddPerso(array $data = []): void
    {
        $id = $data['id'] ?? null;
        $perso = $id ? PersonnageService::hydrate($this->service->getDao()->getByID($id)) : new Personnage();

        echo $this->templates->render('add-perso', [
            'title' => $id ? 'Éditer un personnage' : 'Ajouter un personnage',
            'perso' => $perso
        ]);
    }

    public function addPerso(array $data = []): void
    {
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
                $perso = new Personnage(uniqid(), $name, $element, $unitclass, $rarity, $origin, $urlImg);
                $this->service->getDao()->insert($perso);
                $msg = "Personnage ajouté !";
            }

            $this->mainController->index($msg);
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
        $result = $this->service->getDao()->delete($id);

        if($result) {
            $this->mainController->index("Personnage supprimé avec succès");
        } else {
            $this->mainController->index("Le personnage n'existe pas", "error");
        }
    }

}
