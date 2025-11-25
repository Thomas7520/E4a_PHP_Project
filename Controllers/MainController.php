<?php

namespace Controllers;

use League\Plates\Engine;
use Services\ElementService;
use Services\OriginService;
use Services\PersonnageService;
use Services\UnitClassService;
use function Helpers\toast;

class MainController
{
    private Engine $templates;
    public PersonnageService $personnageService;
    public OriginService $originService;
    public ElementService $elementService;
    public UnitClassService $classServiceService;



    public function __construct()
    {

        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->personnageService = new PersonnageService();
        $this->originService = new OriginService();
        $this->elementService = new ElementService();
        $this->classServiceService = new UnitClassService();
    }

    public function index(string $msg='', string $type='success'): void
    {

        if($msg != '')
            toast($msg, $type);

        $listPersonnage = PersonnageService::hydrateAll($this->personnageService->getDao()->getAll());
        $listOrigins = OriginService::hydrateAll($this->originService->getDao()->getAll());
        $listElements = ElementService::hydrateAll($this->elementService->getDao()->getAll());
        $listUnitClass = UnitClassService::hydrateAll($this->classServiceService->getDao()->getAll());

// Map par ID pour accès rapide en vue
        $elementsById = [];
        foreach ($listElements as $el) {
            $elementsById[$el->getId()] = $el;
        }

        $originsById = [];
        foreach ($listOrigins as $or) {
            $originsById[$or->getId()] = $or;
        }

        $unitclassesById = [];
        foreach ($listUnitClass as $uc) {
            $unitclassesById[$uc->getId()] = $uc;
        }

        echo $this->templates->render('home', [
            'listPersonnage' => $listPersonnage,
            'gameName' => 'Genshin Impact',
            'elements' => $elementsById,
            'unitclasses' => $unitclassesById,
            'origins' => $originsById
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

    public function notFound(): void
    {
        echo $this->templates->render('not-found', [
            'title' => 'Page non trouvée'
        ]);
    }
}
