<?php

namespace Models\Parameter\Element;

use Models\BasePDODAO;
use PDO;

class ElementDAO extends BasePDODAO
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM ELEMENT";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM ELEMENT WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function insert(Element $element): bool
    {
        $sql = "INSERT INTO ELEMENT (id, name, url_img) VALUES (?, ?, ?)";
        $params = [
            $element->getId() ?? uniqid(),
            $element->getName(),
            $element->getUrlImg()
        ];

        $stmt = $this->execRequest($sql, $params);
        return $stmt !== false;
    }

    public function update(Element $element): bool
    {
        $sql = "UPDATE ELEMENT SET name = ?, url_img = ? WHERE id = ?";
        $params = [
            $element->getName(),
            $element->getUrlImg(),
            $element->getId()
        ];

        $stmt = $this->execRequest($sql, $params);
        return $stmt !== false;
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM ELEMENT WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt !== false && $stmt->rowCount() > 0;
    }
}
