<?php

namespace Controllers;

use League\Plates\Engine;
use Services\ElementService;
use Services\OriginService;
use Services\UnitClassService;


class ParameterController
{
    private Engine $templates;
    private ElementService $elementService;
    private OriginService $originService;
    private UnitClassService $unitClassService;
    private MainController $mainController;

    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->elementService = new ElementService($mainController->logger);
        $this->originService = new OriginService($mainController->logger);
        $this->unitClassService = new UnitClassService($mainController->logger);
    }

    /**
     * Page de choix pour ajouter un paramètre (Element, Origin, UnitClass)
     */
    public function displayAddParameter(): void
    {
        echo $this->templates->render('add-parameter', [
            'title' => 'Ajouter un paramètre'
        ]);
    }

    /**
     * Affiche le formulaire d'ajout / édition selon le type et l'id
     */
    public function displayAddParameterForm(string $type, ?string $id = null): void
    {
        $service = $this->getServiceByType($type);
        $param = $service::hydrate($id ? $service->getDao()->getByID($id) : []);


        echo $this->templates->render("add-$type", [
            'title' => $id ? "Éditer $type" : "Ajouter $type",
            $type => $param
        ]);
    }

    /**
     * Ajoute ou modifie un paramètre
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
            $msg = "$type mis à jour !";
        } else {
            $className = $service->getEntityClass();
            $param = new $className(uniqid(), $name, $imgUrl);
            $service->getDao()->insert($param);
            $msg = "$type ajouté !";
        }

        $this->mainController->index($msg);
    }

    /**
     * Supprime un paramètre
     */
    public function deleteParameter(string $type, string $id): void
    {
        $service = $this->getServiceByType($type);
        $result = $service->getDao()->delete($id);

        $msg = $result ? "$type supprimé avec succès" : "$type introuvable";
        $this->mainController->index($msg);
    }

    /**
     * Retourne le service correspondant au type
     */
    private function getServiceByType(string $type)
    {
        return match($type) {
            'element'   => $this->elementService,
            'origin'    => $this->originService,
            'unitclass' => $this->unitClassService,
            default => throw new \Exception("Type inconnu: $type")
        };
    }
}
