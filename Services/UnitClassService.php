<?php

namespace Services;

use Models\Parameter\UnitClass\UnitClass;
use Models\Parameter\UnitClass\UnitClassDAO;

/**
 * Service layer for UnitClass entities.
 * Provides hydration and DAO access.
 */
class UnitClassService
{
    private UnitClassDAO $dao;

    /**
     * Constructor.
     *
     * @param \Models\Logger $logger Logger instance for DAO operations.
     */
    public function __construct($logger)
    {
        $this->dao = new UnitClassDAO($logger);
    }

    /**
     * Converts a raw data array (from the DAO) into a UnitClass instance.
     *
     * @param array $data Raw database row.
     * @return UnitClass Hydrated UnitClass object.
     */
    public static function hydrate(array $data): UnitClass
    {
        $unitClass = new UnitClass();

        foreach ($data as $key => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (method_exists($unitClass, $method)) {
                $unitClass->$method($value);
            }
        }

        return $unitClass;
    }

    /**
     * Converts multiple raw rows into an array of UnitClass objects.
     *
     * @param array $rows Array of associative arrays (DB rows).
     * @return UnitClass[] Array of hydrated UnitClass objects.
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
     * @return UnitClassDAO
     */
    public function getDao(): UnitClassDAO
    {
        return $this->dao;
    }

    /**
     * Returns the fully qualified class name of the entity managed by this service.
     *
     * @return string
     */
    public function getEntityClass(): string
    {
        return UnitClass::class;
    }
}
