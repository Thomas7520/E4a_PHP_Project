<?php

namespace Models\Parameter\UnitClass;

use Models\BasePDODAO;
use Models\Logger;
use PDO;

/**
 * Data Access Object for UnitClass entities.
 * Handles CRUD operations with logging.
 */
class UnitClassDAO extends BasePDODAO
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Retrieve all unit classes from the database.
     *
     * @return array List of unit classes as associative arrays.
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM UNITCLASS";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieve a unit class by its ID.
     *
     * @param string $id UnitClass ID.
     * @return array|null UnitClass data or null if not found.
     */
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM UNITCLASS WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    /**
     * Insert a new unit class into the database.
     *
     * @param UnitClass $unitClass UnitClass to insert.
     * @return bool True on success, false on failure.
     */
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

    /**
     * Update an existing unit class in the database.
     *
     * @param UnitClass $unitClass UnitClass to update.
     * @return bool True on success, false on failure.
     */
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

    /**
     * Delete a unit class from the database by ID.
     *
     * @param string $id UnitClass ID.
     * @return bool True if deleted successfully, false otherwise.
     */
    public function delete(string $id): bool
    {
        $sql = "DELETE FROM UNITCLASS WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $success = $stmt !== false && $stmt->rowCount() > 0;

        $this->logger->log('DELETE', 'UNITCLASS', $success, "id={$id}");

        return $success;
    }
}
