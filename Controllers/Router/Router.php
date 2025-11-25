<?php

namespace Controllers\Router; // 1. Namespace conforme au dossier

use Controllers\MainController;
use Controllers\PersonnageController;
use Exceptions\RouteNotFoundException;
// Tu devras importer tes classes de Routes ici (RouteIndex, RouteAddPerso, etc.)
use Routes\RouteIndex;
use Routes\RouteAddPerso;
use Routes\RouteAddElement;
use Routes\RouteLogs;
use Routes\RouteLogin;
use Routes\RouteDelPerso;

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
        $this->ctrlList = [
            'main' => new MainController(),
            'perso' => new PersonnageController(new MainController())
        ];
    }

    private function createRouteList(): void
    {
        $this->routeList = [
            'index'             => new RouteIndex($this->ctrlList['main']),
            'add-perso'         => new RouteAddPerso($this->ctrlList['perso']),
            'add-perso-element' => new RouteAddElement($this->ctrlList['perso']),
            'logs'              => new RouteLogs($this->ctrlList['main']),
            'login'             => new RouteLogin($this->ctrlList['main']),
            'del-perso'         => new RouteDelPerso($this->ctrlList['perso']),
            'edit-perso'        => new RouteAddPerso($this->ctrlList['perso']),
            'not-found'        => new RouteNotFoundException($this->ctrlList['main']),
        ];
    }

    public function routing(array $get, array $post): void
    {
        $action = $get[$this->action_key] ?? 'index';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        try {
            // Vérification si la route existe
            if (array_key_exists($action, $this->routeList)) {
                $route = $this->routeList[$action];

                //throw new RouteNotFoundException("La page demandée n'existe pas.");
            } else {
                // TODO NE MARCHE PAS A FIX
                $route = $this->routeList["not-found"];

            }


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