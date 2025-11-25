<?php

namespace Services;


use Models\Parameter\UnitClass\UnitClass;
use Models\Parameter\UnitClass\UnitClassDAO;

class UnitClassService
{
    private UnitClassDAO $dao;

    public function __construct()
    {
        $this->dao = new UnitClassDAO();
    }

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

    public static function hydrateAll(array $rows): array
    {
        $result = [];
        foreach ($rows as $row) {
            $result[] = self::hydrate($row);
        }
        return $result;
    }

    public function getDao(): UnitClassDAO
    {
        return $this->dao;
    }

    public function getEntityClass(): string
    {
        return UnitClass::class;
    }
}
