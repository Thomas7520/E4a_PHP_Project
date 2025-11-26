<?php

namespace Models\Parameter\Origin;

use Models\BasePDODAO;
use Models\Logger;
use PDO;

class OriginDAO extends BasePDODAO
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM ORIGIN";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM ORIGIN WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function insert(Origin $origin): bool
    {
        $sql = "INSERT INTO ORIGIN (name, url_img) VALUES (?, ?)";
        $params = [
            $origin->getName(),
            $origin->getUrlImg()
        ];

        $success = $this->execRequest($sql, $params) !== false;

        $this->logger->log('CREATE', 'ORIGIN', $success,
            "id={$origin->getId()} name={$origin->getName()}");

        return $success;
    }

    public function update(Origin $origin): bool
    {
        $sql = "UPDATE ORIGIN SET name = ?, url_img = ? WHERE id = ?";
        $params = [
            $origin->getName(),
            $origin->getUrlImg(),
            $origin->getId()
        ];

        $success = $this->execRequest($sql, $params) !== false;

        $this->logger->log('UPDATE', 'ORIGIN', $success,
            "id={$origin->getId()} name={$origin->getName()}");

        return $success;
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM ORIGIN WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $success = $stmt !== false && $stmt->rowCount() > 0;

        $this->logger->log('DELETE', 'ORIGIN', $success, "id={$id}");

        return $success;
    }
}
