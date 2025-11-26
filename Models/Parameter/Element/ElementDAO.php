<?php

namespace Models\Parameter\Element;

use Models\BasePDODAO;
use Models\Logger;
use PDO;

/**
 * Data Access Object for Element entities.
 * Handles CRUD operations with logging.
 */
class ElementDAO extends BasePDODAO
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Retrieve all elements from the database.
     *
     * @return array List of elements as associative arrays.
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM ELEMENT";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieve an element by its ID.
     *
     * @param string $id Element ID.
     * @return array|null Element data or null if not found.
     */
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM ELEMENT WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    /**
     * Insert a new element into the database.
     *
     * @param Element $element Element to insert.
     * @return bool True on success, false on failure.
     */
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

    /**
     * Update an existing element in the database.
     *
     * @param Element $element Element to update.
     * @return bool True on success, false on failure.
     */
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

    /**
     * Delete an element from the database by ID.
     *
     * @param string $id Element ID.
     * @return bool True if deleted successfully, false otherwise.
     */
    public function delete(string $id): bool
    {
        $sql = "DELETE FROM ELEMENT WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $success = $stmt !== false && $stmt->rowCount() > 0;

        $this->logger->log('DELETE', 'ELEMENT', $success, "id={$id}");

        return $success;
    }
}
