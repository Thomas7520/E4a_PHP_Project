<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Logger;
use Services\ElementService;
use Services\OriginService;
use Services\PersonnageService;
use Services\UnitClassService;
use function Helpers\toast;

/**
 * Main controller handling core application pages and data.
 */
class MainController
{
    private Engine $templates;

    public PersonnageService $personnageService;
    public OriginService $originService;
    public ElementService $elementService;
    public UnitClassService $classServiceService;

    public Logger $logger;

    /**
     * Constructor.
     *
     * Initializes services and templating engine.
     */
    public function __construct()
    {
        $this->logger = new Logger();
        $this->templates = new Engine(__DIR__ . '/../Views');

        $this->personnageService = new PersonnageService($this->logger);
        $this->originService = new OriginService($this->logger);
        $this->elementService = new ElementService($this->logger);
        $this->classServiceService = new UnitClassService($this->logger);
    }

    /**
     * Display the main home page with lists of characters, origins, elements, and unit classes.
     *
     * @param string $msg Optional message to display (e.g., success message).
     * @param string $type Type of message (e.g., 'success', 'error').
     */
    public function index(string $msg = '', string $type = 'success'): void
    {
        if ($msg !== '') {
            toast($msg, $type);
        }

        $listPersonnage = PersonnageService::hydrateAll($this->personnageService->getDao()->getAll());
        $listOrigins = OriginService::hydrateAll($this->originService->getDao()->getAll());
        $listElements = ElementService::hydrateAll($this->elementService->getDao()->getAll());
        $listUnitClass = UnitClassService::hydrateAll($this->classServiceService->getDao()->getAll());

        // Map by ID for quick access in the view
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
            'gameName'       => 'Genshin Impact',
            'elements'       => $elementsById,
            'unitclasses'    => $unitclassesById,
            'origins'        => $originsById
        ]);
    }

    /**
     * Display the logs page.
     */
    public function logs(): void
    {
        echo $this->templates->render('logs', [
            'title' => 'Site Logs'
        ]);
    }

    /**
     * Display the login page.
     */
    public function login(): void
    {
        echo $this->templates->render('login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Display the 404 page not found view.
     */
    public function notFound(): void
    {
        echo $this->templates->render('not-found', [
            'title' => 'Page Not Found'
        ]);
    }
}
