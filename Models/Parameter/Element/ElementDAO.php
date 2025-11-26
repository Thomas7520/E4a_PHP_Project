<?php

namespace Models\Parameter\Element;

use Models\BasePDODAO;
use Models\Logger;
use PDO;

class ElementDAO extends BasePDODAO
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

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
        $sql = "INSERT INTO ELEMENT (name, url_img) VALUES (?, ?)";
        $params = [
            $element->getName(),
            $element->getUrlImg()
        ];

        $success = $this->execRequest($sql, $params) !== false;

        $this->logger->log('CREATE', 'ELEMENT', $success,
            "id={$element->getId()} name={$element->getName()}");

        return $success;
    }

    public function update(Element $element): bool
    {
        $sql = "UPDATE ELEMENT SET name = ?, url_img = ? WHERE id = ?";
        $params = [
            $element->getName(),
            $element->getUrlImg(),
            $element->getId()
        ];

        $success = $this->execRequest($sql, $params) !== false;

        $this->logger->log('UPDATE', 'ELEMENT', $success,
            "id={$element->getId()} name={$element->getName()}");

        return $success;
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM ELEMENT WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $success = $stmt !== false && $stmt->rowCount() > 0;

        $this->logger->log('DELETE', 'ELEMENT', $success, "id={$id}");

        return $success;
    }
}
