<?php

namespace Models\Personnage;

use Models\BasePDODAO;
use Models\Logger;
use PDO;

class PersonnageDAO extends BasePDODAO
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM PERSONNAGE";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM PERSONNAGE WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

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

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM PERSONNAGE WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $success = $stmt !== false && $stmt->rowCount() > 0;

        $this->logger->log('DELETE', 'PERSONNAGE', $success, "id={$id}");

        return $success;
    }
}
