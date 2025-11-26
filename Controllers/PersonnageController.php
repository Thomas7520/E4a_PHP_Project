<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Personnage\Personnage;
use Services\ElementService;
use Services\OriginService;
use Services\PersonnageService;
use Services\UnitClassService;

/**
 * Controller for handling character (Personnage) operations:
 * adding, editing, and deleting characters.
 */
class PersonnageController
{
    private Engine $templates;
    private MainController $mainController;

    /**
     * Constructor.
     *
     * @param MainController $mainController Main controller for services and views.
     */
    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    /**
     * Display the add/edit character form.
     *
     * @param array $data Optional data containing 'id' for editing.
     */
    public function displayAddPerso(array $data = []): void
    {
        $id = $data['id'] ?? null;
        $perso = $id
            ? PersonnageService::hydrate($this->mainController->personnageService->getDao()->getByID($id))
            : new Personnage();

        // Get lists for selection dropdowns
        $elements = ElementService::hydrateAll($this->mainController->elementService->getDao()->getAll());
        $origins = OriginService::hydrateAll($this->mainController->originService->getDao()->getAll());
        $unitclasses = UnitClassService::hydrateAll($this->mainController->classServiceService->getDao()->getAll());

        echo $this->templates->render('add-perso', [
            'title'       => $id ? 'Edit Character' : 'Add Character',
            'perso'       => $perso,
            'elements'    => $elements,
            'origins'     => $origins,
            'unitclasses' => $unitclasses
        ]);
    }

    /**
     * Add a new character or update an existing one.
     *
     * @param array $data Form data containing character fields.
     */
    public function addPerso(array $data = []): void
    {
        $id = $data['id'] ?? null;
        $name = $data['name'] ?? '';
        $element = $data['element'] ?? '';
        $rarity = (int)($data['rarity'] ?? 1);
        $unitclass = $data['unitclass'] ?? '';
        $origin = isset($data['origin']) && $data['origin'] !== '' ? (int)$data['origin'] : null;
        $urlImg = $data['urlImg'] ?? '';

        if ($id) {
            // Editing existing character
            $perso = PersonnageService::hydrate($this->mainController->personnageService->getDao()->getByID($id));
            $perso->setName($name);
            $perso->setElement($element);
            $perso->setRarity($rarity);
            $perso->setUnitclass($unitclass);
            $perso->setOrigin($origin);
            $perso->setUrlImg($urlImg);
            $this->mainController->personnageService->getDao()->update($perso);
            $msg = "Character updated!";
        } else {
            // Creating new character
            $perso = new Personnage(uniqid(), $name, $element, $unitclass, $origin, $rarity, $urlImg);
            $this->mainController->personnageService->getDao()->insert($perso);
            $msg = "Character added!";
        }

        $this->mainController->index($msg);
    }

    /**
     * Display the add element page (optional helper method).
     *
     * @param string $id Optional element ID.
     */
    public function displayAddElement(string $id = ""): void
    {
        echo $this->templates->render('add-element', [
            'title' => 'Add Element',
            'id'    => $id
        ]);
    }

    /**
     * Delete a character by ID.
     *
     * @param string $id Character ID to delete.
     */
    public function deletePerso(string $id): void
    {
        $result = $this->mainController->personnageService->getDao()->delete($id);

        if ($result) {
            $this->mainController->index("Character successfully deleted");
        } else {
            $this->mainController->index("Character does not exist", "error");
        }
    }
}
