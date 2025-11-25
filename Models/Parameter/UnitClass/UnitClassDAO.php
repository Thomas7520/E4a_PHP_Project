<?php

namespace Models\Parameter\UnitClass;

use Models\BasePDODAO;
use PDO;

class UnitClassDAO extends BasePDODAO
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM UNITCLASS";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM UNITCLASS WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function insert(UnitClass $unitClass): bool
    {
        $sql = "INSERT INTO UNITCLASS (id, name, url_img) VALUES (?, ?, ?)";
        $params = [
            $unitClass->getId() ?? uniqid(),
            $unitClass->getName(),
            $unitClass->getUrlImg()
        ];

        $stmt = $this->execRequest($sql, $params);
        return $stmt !== false;
    }

    public function update(UnitClass $unitClass): bool
    {
        $sql = "UPDATE UNITCLASS SET name = ?, url_img = ? WHERE id = ?";
        $params = [
            $unitClass->getName(),
            $unitClass->getUrlImg(),
            $unitClass->getId()
        ];

        $stmt = $this->execRequest($sql, $params);
        return $stmt !== false;
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM UNITCLASS WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt !== false && $stmt->rowCount() > 0;
    }
}
