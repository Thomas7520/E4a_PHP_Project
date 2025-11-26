<?php

namespace Controllers;

use League\Plates\Engine;
use Services\ElementService;
use Services\OriginService;
use Services\UnitClassService;

/**
 * Controller to handle creation, edition, and deletion of parameters:
 * Elements, Origins, and UnitClasses.
 */
class ParameterController
{
    private Engine $templates;
    private ElementService $elementService;
    private OriginService $originService;
    private UnitClassService $unitClassService;
    private MainController $mainController;

    /**
     * Constructor.
     *
     * @param MainController $mainController Main controller for redirections and views.
     */
    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->elementService = new ElementService($mainController->logger);
        $this->originService = new OriginService($mainController->logger);
        $this->unitClassService = new UnitClassService($mainController->logger);
    }

    /**
     * Display the selection page to choose which parameter to add
     * (Element, Origin, or UnitClass).
     */
    public function displayAddParameter(): void
    {
        echo $this->templates->render('add-parameter', [
            'title' => 'Add a Parameter'
        ]);
    }

    /**
     * Display the add/edit form for a specific type and optional ID.
     *
     * @param string $type Parameter type ('element', 'origin', 'unitclass').
     * @param string|null $id Optional ID for editing an existing parameter.
     */
    public function displayAddParameterForm(string $type, ?string $id = null): void
    {
        $service = $this->getServiceByType($type);
        $param = $service::hydrate($id ? $service->getDao()->getByID($id) : []);

        echo $this->templates->render("add-$type", [
            'title' => $id ? "Edit $type" : "Add $type",
            $type   => $param
        ]);
    }

    /**
     * Add a new parameter or update an existing one.
     *
     * @param array $data Form data with 'id', 'name', and 'img_url'.
     * @param string $type Parameter type ('element', 'origin', 'unitclass').
     */
    public function addParameter(array $data, string $type): void
    {
        $id = $data['id'] ?? null;
        $name = $data['name'] ?? '';
        $imgUrl = $data['img_url'] ?? '';

        $service = $this->getServiceByType($type);

        if ($id) {
            $param = $service::hydrate($service->getDao()->getByID($id));
            $param->setName($name);
            $param->setUrlImg($imgUrl);
            $service->getDao()->update($param);
            $msg = "$type updated!";
        } else {
            $className = $service->getEntityClass();
            $param = new $className(-1, $name, $imgUrl);
            $service->getDao()->insert($param);
            $msg = "$type added!";
        }

        $this->mainController->index($msg);
    }

    /**
     * Delete a parameter by type and ID.
     *
     * @param string $type Parameter type ('element', 'origin', 'unitclass').
     * @param string $id ID of the parameter to delete.
     */
    public function deleteParameter(string $type, string $id): void
    {
        $service = $this->getServiceByType($type);
        $result = $service->getDao()->delete($id);

        $msg = $result ? "$type successfully deleted" : "$type not found";
        $this->mainController->index($msg);
    }

    /**
     * Return the service corresponding to the given type.
     *
     * @param string $type Parameter type.
     * @return ElementService|OriginService|UnitClassService
     * @throws \Exception If the type is unknown.
     */
    private function getServiceByType(string $type): OriginService|ElementService|UnitClassService
    {
        return match($type) {
            'element'   => $this->elementService,
            'origin'    => $this->originService,
            'unitclass' => $this->unitClassService,
            default     => throw new \Exception("Unknown type: $type")
        };
    }
}
