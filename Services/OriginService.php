<?php

namespace Services;

use Models\Parameter\Origin\Origin;
use Models\Parameter\Origin\OriginDAO;

/**
 * Service layer for Origin entities.
 * Provides hydration and DAO access.
 */
class OriginService
{
    private OriginDAO $dao;

    /**
     * Constructor.
     *
     * @param \Models\Logger $logger Logger instance for DAO operations.
     */
    public function __construct($logger)
    {
        $this->dao = new OriginDAO($logger);
    }

    /**
     * Converts a raw data array into an Origin instance.
     *
     * @param array $data Raw data (associative array from DB).
     * @return Origin Hydrated Origin object.
     */
    public static function hydrate(array $data): Origin
    {
        $origin = new Origin();

        foreach ($data as $key => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (method_exists($origin, $method)) {
                $origin->$method($value);
            }
        }

        return $origin;
    }

    /**
     * Converts multiple raw rows into an array of Origin objects.
     *
     * @param array $rows Array of associative arrays (DB rows).
     * @return Origin[] Array of hydrated Origin objects.
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
     * Get the DAO associated with this service.
     *
     * @return OriginDAO
     */
    public function getDao(): OriginDAO
    {
        return $this->dao;
    }

    /**
     * Returns the fully qualified class name of the entity.
     *
     * @return string
     */
    public function getEntityClass(): string
    {
        return Origin::class;
    }
}
