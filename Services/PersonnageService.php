<?php

namespace Services;

use Models\Personnage\Personnage;
use Models\Personnage\PersonnageDAO;

class PersonnageService
{
    private PersonnageDAO $dao;

    public function __construct($logger)
    {

        $this->dao = new PersonnageDAO($logger);
    }


    /**
     * Transforme un tableau de données brutes (issue du DAO)
     * en une instance de Personnage.
     *
     * @param array $data Données de la base de données
     * @return Personnage
     */
    public static function hydrate(array $data): Personnage
    {
        $personnage = new Personnage();

        foreach ($data as $key => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));

            if (method_exists($personnage, $method)) {
                $personnage->$method($value);
            }
        }

        return $personnage;
    }

    /**
     * Transforme plusieurs lignes SQL en tableau d'objets Personnage
     *
     * @param array $rows
     * @return Personnage[]
     */
    public static function hydrateAll(array $rows): array
    {
        $result = [];

        foreach ($rows as $row) {
            $result[] = self::hydrate($row);
        }

        return $result;
    }

    /**
     * @return PersonnageDAO
     */
    public function getDao(): PersonnageDAO
    {
        return $this->dao;
    }
}
