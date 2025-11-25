<?php

namespace Services;



use Models\Parameter\Origin\Origin;
use Models\Parameter\Origin\OriginDAO;

class OriginService
{
    private OriginDAO $dao;

    public function __construct()
    {
        $this->dao = new OriginDAO();
    }

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

    public static function hydrateAll(array $rows): array
    {
        $result = [];
        foreach ($rows as $row) {
            $result[] = self::hydrate($row);
        }
        return $result;
    }

    public function getDao(): OriginDAO
    {
        return $this->dao;
    }

    public function getEntityClass(): string
    {
        return Origin::class;
    }
}
