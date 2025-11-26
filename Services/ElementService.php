<?php

namespace Services;

use Models\Parameter\Element\Element;
use Models\Parameter\Element\ElementDAO;

/**
 * Service layer for Element entities.
 * Provides hydration and DAO access.
 */
class ElementService
{
    private ElementDAO $dao;

    /**
     * Constructor.
     *
     * @param \Models\Logger $logger Logger instance for DAO operations.
     */
    public function __construct($logger)
    {
        $this->dao = new ElementDAO($logger);
    }

    /**
     * Converts a raw data array into an Element instance.
     *
     * @param array $data Raw data (associative array from DB).
     * @return Element Hydrated Element object.
     */
    public static function hydrate(array $data): Element
    {
        $element = new Element();

        foreach ($data as $key => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (method_exists($element, $method)) {
                $element->$method($value);
            }
        }

        return $element;
    }

    /**
     * Converts multiple raw rows into an array of Element objects.
     *
     * @param array $rows Array of associative arrays (DB rows).
     * @return Element[] Array of hydrated Element objects.
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
     * @return ElementDAO
     */
    public function getDao(): ElementDAO
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
        return Element::class;
    }
}
