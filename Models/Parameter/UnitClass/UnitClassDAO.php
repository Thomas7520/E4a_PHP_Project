<?php

namespace Models\Parameter\UnitClass;

use Models\BasePDODAO;
use Models\Logger;
use PDO;

class UnitClassDAO extends BasePDODAO
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

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
        $sql = "INSERT INTO UNITCLASS (name, url_img) VALUES (?, ?)";
        $params = [
            $unitClass->getName(),
            $unitClass->getUrlImg()
        ];

        $success = $this->execRequest($sql, $params) !== false;

        $this->logger->log('CREATE', 'UNITCLASS', $success,
            "id={$unitClass->getId()} name={$unitClass->getName()}");

        return $success;
    }

    public function update(UnitClass $unitClass): bool
    {
        $sql = "UPDATE UNITCLASS SET name = ?, url_img = ? WHERE id = ?";
        $params = [
            $unitClass->getName(),
            $unitClass->getUrlImg(),
            $unitClass->getId()
        ];

        $success = $this->execRequest($sql, $params) !== false;

        $this->logger->log('UPDATE', 'UNITCLASS', $success,
            "id={$unitClass->getId()} name={$unitClass->getName()}");

        return $success;
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM UNITCLASS WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $success = $stmt !== false && $stmt->rowCount() > 0;

        $this->logger->log('DELETE', 'UNITCLASS', $success, "id={$id}");

        return $success;
    }
}
