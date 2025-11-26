<?php

namespace Models\Personnage;

use Models\BasePDODAO;
use Models\Logger;
use PDO;

/**
 * Data Access Object for Personnage entities.
 * Handles CRUD operations and logging.
 */
class PersonnageDAO extends BasePDODAO
{
    private Logger $logger;

    /**
     * Constructor.
     *
     * @param Logger $logger Logger instance for recording actions.
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Retrieve all characters from the database.
     *
     * @return array List of characters as associative arrays.
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM PERSONNAGE";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieve a character by its ID.
     *
     * @param string $id Character ID.
     * @return array|null Character data or null if not found.
     */
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM PERSONNAGE WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    /**
     * Insert a new character into the database.
     *
     * @param Personnage $perso Character to insert.
     * @return bool True on success, false on failure.
     */
    public function insert(Personnage $perso): bool
    {
        $sql = "INSERT INTO PERSONNAGE (id, name, element, unitclass, origin, rarity, url_img)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $perso->getId() ?? uniqid(),
            $perso->getName(),
            $perso->getElement(),
            $perso->getUnitclass(),
            $perso->getOrigin(),
            $perso->getRarity(),
            $perso->getUrlImg()
        ];

        $success = $this->execRequest($sql, $params) !== false;

        $this->logger->log('CREATE', 'PERSONNAGE', $success,
            "id={$perso->getId()} name={$perso->getName()}");

        return $success;
    }

    /**
     * Update an existing character in the database.
     *
     * @param Personnage $perso Character to update.
     * @return bool True on success, false on failure.
     */
    public function update(Personnage $perso): bool
    {
        $sql = "UPDATE PERSONNAGE
                SET name = ?, element = ?, unitclass = ?, origin = ?, rarity = ?, url_img = ?
                WHERE id = ?";
        $params = [
            $perso->getName(),
            $perso->getElement(),
            $perso->getUnitclass(),
            $perso->getOrigin(),
            $perso->getRarity(),
            $perso->getUrlImg(),
            $perso->getId()
        ];

        $success = $this->execRequest($sql, $params) !== false;

        $this->logger->log('UPDATE', 'PERSONNAGE', $success,
            "id={$perso->getId()} name={$perso->getName()}");

        return $success;
    }

    /**
     * Delete a character from the database by ID.
     *
     * @param string $id Character ID.
     * @return bool True if deleted successfully, false otherwise.
     */
    public function delete(string $id): bool
    {
        $sql = "DELETE FROM PERSONNAGE WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $success = $stmt !== false && $stmt->rowCount() > 0;

        $this->logger->log('DELETE', 'PERSONNAGE', $success, "id={$id}");

        return $success;
    }
}
