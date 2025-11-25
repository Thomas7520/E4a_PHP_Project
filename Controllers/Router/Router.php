<?php

namespace Controllers\Router;

use Controllers\MainController;
use Controllers\PersonnageController;
use Controllers\ParameterController;
use Exceptions\RouteNotFoundException;

// Routes génériques
use Routes\RouteDelParameter;
use Routes\RouteIndex;
use Routes\RouteLogin;
use Routes\RouteLogs;

// Routes Personnage
use Routes\Personnage\RouteAddPerso;
use Routes\Personnage\RouteDelPerso;

// Routes Parameter
use Routes\Parameter\RouteAddElement;
use Routes\Parameter\RouteAddOrigin;
use Routes\Parameter\RouteAddUnitClass;
use Routes\RouteAddParameter;

// Routes Element / Origin / UnitClass deletion
use Routes\RouteDelElement;

class Router
{
    private array $routeList = [];
    private array $ctrlList = [];
    private string $action_key;

    public function __construct(string $action_key = 'action')
    {
        $this->action_key = $action_key;
        $this->createControllerList();
        $this->createRouteList();
    }

    private function createControllerList(): void
    {
        $mainCtrl = new MainController();

        $this->ctrlList = [
            'main'      => $mainCtrl,
            'perso'     => new PersonnageController($mainCtrl),
            'parameter' => new ParameterController($mainCtrl), // utilisé pour toutes les routes add-xxx
        ];
    }

    private function createRouteList(): void
    {
        $this->routeList = [
            'index'          => new RouteIndex($this->ctrlList['main']),
            'login'          => new RouteLogin($this->ctrlList['main']),
            'logs'           => new RouteLogs($this->ctrlList['main']),

            // Routes Personnage
            'add-perso'      => new RouteAddPerso($this->ctrlList['perso']),
            'edit-perso'     => new RouteAddPerso($this->ctrlList['perso']),
            'del-perso'      => new RouteDelPerso($this->ctrlList['perso']),

            // Routes Parameter
            'add-element'    => new RouteAddElement($this->ctrlList['parameter']),
            'add-origin'     => new RouteAddOrigin($this->ctrlList['parameter']),
            'add-unitclass'  => new RouteAddUnitClass($this->ctrlList['parameter']),
            'add-parameter'  => new RouteAddParameter($this->ctrlList['parameter']),

            // Routes de suppression génériques
            'del-parameter'    => new RouteDelParameter($this->ctrlList['parameter']),

            // Route fallback
            'not-found'      => new RouteNotFoundException($this->ctrlList['main']),
        ];
    }

    public function routing(array $get, array $post): void
    {
        $action = $get[$this->action_key] ?? 'index';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        try {
            $route = $this->routeList[$action] ?? $this->routeList["not-found"];

            if ($method === 'POST' && !empty($post)) {
                $route->action($post, 'POST');
            } else {
                $route->action($get, 'GET');
            }

        } catch (\Exception $e) {
            echo "<div style='color:red; background:#ffdada; padding:20px; border:1px solid red;'>";
            echo "<strong>Erreur système : </strong>" . $e->getMessage();
            echo "</div>";
        }
    }
}
