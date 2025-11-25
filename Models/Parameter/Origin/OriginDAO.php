<?php

namespace Models\Parameter\Origin;

use Models\BasePDODAO;
use PDO;

class OriginDAO extends BasePDODAO
{
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
        $sql = "INSERT INTO ORIGIN (id, name, url_img) VALUES (?, ?, ?)";
        $params = [
            $origin->getId() ?? uniqid(),
            $origin->getName(),
            $origin->getUrlImg()
        ];

        $stmt = $this->execRequest($sql, $params);
        return $stmt !== false;
    }

    public function update(Origin $origin): bool
    {
        $sql = "UPDATE ORIGIN SET name = ?, url_img = ? WHERE id = ?";
        $params = [
            $origin->getName(),
            $origin->getUrlImg(),
            $origin->getId()
        ];

        $stmt = $this->execRequest($sql, $params);
        return $stmt !== false;
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM ORIGIN WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt !== false && $stmt->rowCount() > 0;
    }
}
