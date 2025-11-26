<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Personnage\Personnage;
use Services\ElementService;
use Services\OriginService;
use Services\PersonnageService;
use Services\UnitClassService;

class PersonnageController
{
    private Engine $templates;


    private MainController $mainController;

    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
        $this->templates = new Engine(__DIR__ . '/../Views');
    }



    public function displayAddPerso(array $data = []): void
    {
        $id = $data['id'] ?? null;
        $perso = $id ? PersonnageService::hydrate($this->mainController->personnageService->getDao()->getByID($id)) : new Personnage();

        // Récupérer les listes pour les select
        $elements = ElementService::hydrateAll($this->mainController->elementService->getDao()->getAll());
        $origins = OriginService::hydrateAll($this->mainController->originService->getDao()->getAll());
        $unitclasses = UnitClassService::hydrateAll($this->mainController->classServiceService->getDao()->getAll());

        echo $this->templates->render('add-perso', [
            'title' => $id ? 'Éditer un personnage' : 'Ajouter un personnage',
            'perso' => $perso,
            'elements' => $elements,
            'origins' => $origins,
            'unitclasses' => $unitclasses
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
            $origin = isset($data['origin']) && $data['origin'] !== ''
                ? (int)$data['origin']
                : null;
            $urlImg = $data['urlImg'] ?? '';

            if ($id) {
                // Edition
                $perso = PersonnageService::hydrate($this->mainController->personnageService->getDao()->getByID($id));
                $perso->setName($name);
                $perso->setElement($element);
                $perso->setRarity($rarity);
                $perso->setUnitclass($unitclass);
                $perso->setOrigin($origin);
                $perso->setUrlImg($urlImg);
                $this->mainController->personnageService->getDao()->update($perso);
                $msg = "Personnage mis à jour !";
            } else {
                // Création
                $perso = new Personnage(uniqid(), $name, $element, $unitclass, $origin, $rarity, $urlImg);
                $this->mainController->personnageService->getDao()->insert($perso);
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
        $result = $this->mainController->personnageService->getDao()->delete($id);

        if($result) {
            $this->mainController->index("Personnage supprimé avec succès");
        } else {
            $this->mainController->index("Le personnage n'existe pas", "error");
        }
    }

}
