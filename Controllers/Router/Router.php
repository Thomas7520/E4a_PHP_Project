<?php

namespace Controllers\Router;

use Controllers\LoginController;
use Controllers\LogsController;
use Controllers\MainController;
use Controllers\PersonnageController;
use Controllers\ParameterController;
use Exceptions\RouteNotFoundException;

// Generic Routes
use Routes\IRouteSecurity;
use Routes\RouteDelParameter;
use Routes\RouteIndex;
use Routes\RouteLogin;
use Routes\RouteLogout;
use Routes\RouteLogs;

// Personnage Routes
use Routes\Personnage\RouteAddPerso;
use Routes\Personnage\RouteDelPerso;

// Parameter Routes
use Routes\Parameter\RouteAddElement;
use Routes\Parameter\RouteAddOrigin;
use Routes\Parameter\RouteAddUnitClass;
use Routes\RouteAddParameter;

// Deletion Routes for Element / Origin / UnitClass
use Routes\RouteDelElement;
use function Helpers\toast;

/**
 * Router class to handle request routing.
 *
 * Maps actions to route objects and executes the corresponding controller methods.
 */
class Router
{
    private array $routeList = [];
    private array $ctrlList = [];
    private string $action_key;

    /**
     * Constructor.
     *
     * @param string $action_key Query parameter key used to identify the action. Default is 'action'.
     */
    public function __construct(string $action_key = 'action')
    {
        $this->action_key = $action_key;
        $this->createControllerList();
        $this->createRouteList();
    }

    /**
     * Initializes the list of controllers used by routes.
     */
    private function createControllerList(): void
    {
        $mainCtrl = new MainController();

        $this->ctrlList = [
            'main'      => $mainCtrl,
            'perso'     => new PersonnageController($mainCtrl),
            'parameter' => new ParameterController($mainCtrl), // used for all add-xxx routes
            'logs'      => new LogsController($mainCtrl),
            'login'     => new LoginController($mainCtrl),
        ];
    }

    /**
     * Initializes the list of routes mapped to actions.
     */
    private function createRouteList(): void
    {
        $this->routeList = [
            'index'         => new RouteIndex($this->ctrlList['main']),
            'login'         => new RouteLogin($this->ctrlList['login']),
            'logout'        => new RouteLogout($this->ctrlList['login']),
            'logs'          => new RouteLogs($this->ctrlList['logs']),

            // Personnage Routes
            'add-perso'     => new RouteAddPerso($this->ctrlList['perso']),
            'edit-perso'    => new RouteAddPerso($this->ctrlList['perso']),
            'del-perso'     => new RouteDelPerso($this->ctrlList['perso']),

            // Parameter Routes
            'add-element'   => new RouteAddElement($this->ctrlList['parameter']),
            'add-origin'    => new RouteAddOrigin($this->ctrlList['parameter']),
            'add-unitclass' => new RouteAddUnitClass($this->ctrlList['parameter']),
            'add-parameter' => new RouteAddParameter($this->ctrlList['parameter']),

            // Generic deletion routes (NOT DONE)
            'del-parameter' => new RouteDelParameter($this->ctrlList['parameter']),

            // Fallback route
            'not-found'     => new RouteNotFoundException($this->ctrlList['main']),
        ];
    }

    /**
     * Routes the request to the appropriate route object based on the action and request method.
     *
     * @param array $get GET request data.
     * @param array $post POST request data.
     */
    public function routing(array $get, array $post): void
    {
        $action = $get[$this->action_key] ?? 'index';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        try {
            $route = $this->routeList[$action] ?? $this->routeList["not-found"];

            // Protect routes if required
            if ($route instanceof IRouteSecurity) {
                try {
                    $route->protectRoute();
                } catch (\Exception $e) {
                    if ($e->getMessage() === "NOT_LOGGED") {
                        $route = $this->routeList["login"];
                        toast("You do not have access to this page.", "error");
                    }
                }
            }

            // Call the route's action based on the request method
            if ($method === 'POST' && !empty($post)) {
                $route->action($post, 'POST');
            } else {
                $route->action($get, 'GET');
            }

        } catch (\Exception $e) {
            // Display system error
            echo "<div style='color:red; background:#ffdada; padding:20px; border:1px solid red;'>";
            echo "<strong>System Error: </strong>" . $e->getMessage();
            echo "</div>";
        }
    }
}
