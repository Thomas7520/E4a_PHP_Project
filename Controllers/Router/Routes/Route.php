<?php

namespace Routes;

/**
 * Abstract base class for all routes.
 *
 * Provides basic route functionality such as handling GET/POST actions
 * and retrieving parameters from request arrays.
 */
abstract class Route
{
    protected string $name;

    /**
     * Constructor for the route.
     *
     * @param string $name Name of the action (e.g., 'index', 'add-perso').
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Executes the appropriate method based on the request type.
     *
     * @param array $params Parameters from GET or POST.
     * @param string $method Request method, either 'GET' or 'POST'.
     */
    public function action(array $params = [], string $method = 'GET'): void
    {
        if (strtoupper($method) === 'POST') {
            $this->post($params);
        } else {
            $this->get($params);
        }
    }

    /**
     * Retrieves a parameter from an array (e.g., $_GET, $_POST).
     *
     * @param array $array Array containing parameters.
     * @param string $paramName Name of the parameter to retrieve.
     * @param bool $canBeEmpty Whether the parameter can be empty.
     * @return mixed The value of the parameter.
     * @throws \Exception If the parameter is missing or empty when not allowed.
     */
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new \Exception("Parameter '$paramName' is empty");
            }
            return $array[$paramName];
        }

        throw new \Exception("Parameter '$paramName' is missing");
    }

    /**
     * Method to handle GET requests.
     *
     * Must be implemented by subclasses.
     *
     * @param array $params Parameters from the GET request.
     */
    abstract public function get(array $params = []): void;

    /**
     * Method to handle POST requests.
     *
     * Must be implemented by subclasses.
     *
     * @param array $params Parameters from the POST request.
     */
    abstract public function post(array $params = []): void;
}
