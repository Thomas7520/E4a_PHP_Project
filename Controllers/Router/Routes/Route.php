<?php

namespace Routes;

abstract class Route
{
    protected string $name;

    /**
     * Constructeur de la route
     * @param string $name Nom de l'action (ex: 'index', 'add-perso')
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Appelle la méthode get() ou post() selon le type de requête
     * @param array $params Paramètres GET ou POST
     * @param string $method 'GET' ou 'POST'
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
     * Récupère un paramètre dans un tableau (ex: $_GET, $_POST)
     * @param array $array Tableau de paramètres
     * @param string $paramName Nom du paramètre
     * @param bool $canBeEmpty Autoriser un paramètre vide
     * @return mixed
     * @throws \Exception
     */
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new \Exception("Paramètre '$paramName' vide");
            }
            return $array[$paramName];
        }

        throw new \Exception("Paramètre '$paramName' absent");
    }

    /**
     * Méthode à implémenter pour gérer la requête GET
     * @param array $params
     */
    abstract public function get(array $params = []): void;

    /**
     * Méthode à implémenter pour gérer la requête POST
     * @param array $params
     */
    abstract public function post(array $params = []): void;
}
