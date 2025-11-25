<?php

namespace Services;



use Models\Parameter\Element\Element;
use Models\Parameter\Element\ElementDAO;

class ElementService
{
    private ElementDAO $dao;

    public function __construct()
    {
        $this->dao = new ElementDAO();
    }

    /**
     * Transforme un tableau de données brutes en instance d'Element
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
     * Transforme plusieurs lignes SQL en tableau d'objets Element
     *
     * @param array $rows
     * @return Element[]
     */
    public static function hydrateAll(array $rows): array
    {
        $result = [];
        foreach ($rows as $row) {
            $result[] = self::hydrate($row);
        }
        return $result;
    }

    public function getDao(): ElementDAO
    {
        return $this->dao;
    }

    public function getEntityClass(): string
    {
        return Element::class;
    }
}
