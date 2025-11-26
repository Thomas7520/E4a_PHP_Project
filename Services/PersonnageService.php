<?php

namespace Services;

use Models\Personnage\Personnage;
use Models\Personnage\PersonnageDAO;

/**
 * Service layer for Personnage entities.
 * Provides hydration and DAO access.
 */
class PersonnageService
{
    private PersonnageDAO $dao;

    /**
     * Constructor.
     *
     * @param \Models\Logger $logger Logger instance for DAO operations.
     */
    public function __construct($logger)
    {
        $this->dao = new PersonnageDAO($logger);
    }

    /**
     * Converts a raw data array (from the DAO) into a Personnage instance.
     *
     * @param array $data Raw database row.
     * @return Personnage Hydrated Personnage object.
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
     * Converts multiple raw rows into an array of Personnage objects.
     *
     * @param array $rows Array of associative arrays (DB rows).
     * @return Personnage[] Array of hydrated Personnage objects.
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
     * Returns the DAO associated with this service.
     *
     * @return PersonnageDAO
     */
    public function getDao(): PersonnageDAO
    {
        return $this->dao;
    }
}
