<?php

namespace Routes;

use Controllers\MainController;
use Controllers\PersoController;
use Exception;

class Router
{
    private array $routeList = [];
    private string $action_key;

    public function __construct(string $action_key = 'action')
    {
        $this->action_key = $action_key;
        $this->createRouteList();
    }

    private function createRouteList(): void
    {
        $mainController = new MainController();
        $persoController = new PersoController();

        $this->routeList = [
            'index'             => new RouteIndex($mainController),
            'add-perso'         => new RouteAddPerso($persoController),
            'add-perso-element' => new RouteAddElement($persoController),
            'logs'              => new RouteLogs($mainController),
            'login'             => new RouteLogin($mainController),
            'delete-perso'       => new RouteIndex($mainController), /* Pour le moment on met par défaut retour main page */
            'update-perso'       => new RouteIndex($mainController), /* Pour le moment on met par défaut retour main page */
        ];
    }

    public function routing(array $get, array $post): void
    {
        $action = $get[$this->action_key] ?? 'index';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $route = $this->routeList[$action] ?? $this->routeList['index'];

        try {
            if ($method === 'POST' && !empty($post)) {
                $route->action($post, 'POST');
            } else {
                $route->action($get, 'GET');
            }
        } catch (Exception $e) {
            echo "<h3 style='color:red;'>Erreur : " . $e->getMessage() . "</h3>";
        }
    }
}
