<?php

namespace Models\Parameter\Origin;

use Models\BasePDODAO;
use Models\Logger;
use PDO;

/**
 * Data Access Object for Origin entities.
 * Handles CRUD operations with logging.
 */
class OriginDAO extends BasePDODAO
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Retrieve all origins from the database.
     *
     * @return array List of origins as associative arrays.
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM ORIGIN";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieve an origin by its ID.
     *
     * @param string $id Origin ID.
     * @return array|null Origin data or null if not found.
     */
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM ORIGIN WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    /**
     * Insert a new origin into the database.
     *
     * @param Origin $origin Origin to insert.
     * @return bool True on success, false on failure.
     */
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

    /**
     * Update an existing origin in the database.
     *
     * @param Origin $origin Origin to update.
     * @return bool True on success, false on failure.
     */
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

    /**
     * Delete an origin from the database by ID.
     *
     * @param string $id Origin ID.
     * @return bool True if deleted successfully, false otherwise.
     */
    public function delete(string $id): bool
    {
        $sql = "DELETE FROM ORIGIN WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $success = $stmt !== false && $stmt->rowCount() > 0;

        $this->logger->log('DELETE', 'ORIGIN', $success, "id={$id}");

        return $success;
    }
}
