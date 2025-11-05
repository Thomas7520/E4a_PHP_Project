<?php

namespace Models;

use PDO;
use Models\BasePDODAO;

class PersonnageDAO extends BasePDODAO
{
    /**
     * Récupère tous les personnages
     *
     * @return array Tableau associatif de lignes SQL (à hydrater ensuite)
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM PERSONNAGE";
        $stmt = $this->execRequest($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un personnage par son ID
     *
     * @param string $idPersonnage
     * @return ?array Données SQL d’un personnage ou null
     */
    public function getByID(string $idPersonnage): ?array
    {
        $sql = "SELECT * FROM PERSONNAGE WHERE id = ?";
        $stmt = $this->execRequest($sql, [$idPersonnage]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    /**
     * Ajoute un personnage dans la BD
     *
     * @param Personnage $personnage
     * @return bool
     */
    public function insert(Personnage $personnage): bool
    {
        $sql = "INSERT INTO PERSONNAGE (id, name, element, unitclass, rarity, origin, url_img)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $personnage->getId() ?? uniqid(),
            $personnage->getName(),
            $personnage->getElement(),
            $personnage->getUnitclass(),
            $personnage->getRarity(),
            $personnage->getOrigin(),
            $personnage->getUrlImg()
        ];

        $stmt = $this->execRequest($sql, $params);
        return $stmt !== false;
    }

    /**
     * Supprime un personnage par son ID
     */
    public function delete(string $id): bool
    {
        $sql = "DELETE FROM PERSONNAGE WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt !== false;
    }

    /**
     * Met à jour un personnage existant
     */
    public function update(Personnage $personnage): bool
    {
        $sql = "UPDATE PERSONNAGE 
                SET name = ?, element = ?, unitclass = ?, rarity = ?, origin = ?, url_img = ?
                WHERE id = ?";
        $params = [
            $personnage->getName(),
            $personnage->getElement(),
            $personnage->getUnitclass(),
            $personnage->getRarity(),
            $personnage->getOrigin(),
            $personnage->getUrlImg(),
            $personnage->getId()
        ];

        $stmt = $this->execRequest($sql, $params);
        return $stmt !== false;
    }
}
