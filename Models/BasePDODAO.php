<?php
namespace Models;

use Config\Config;
use Exception;
use PDO;
use PDOException;

class BasePDODAO {
    private static $db = null;

    protected static function getDB() {
        if (self::$db === null) {
            try {
                $dsn  = Config::get('dsn');
                $user = Config::get('user');
                $pass = Config::get('pass');

                self::$db = new PDO($dsn, $user, $pass);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return self::$db;
    }

    /**
     * Exécute une requête SQL.
     * @param string $sql La requête SQL
     * @param array|null $params Paramètres pour la requête préparée
     * @return PDOStatement|false
     */
    protected static function execRequest(string $sql, array $params = null) {
        $db = self::getDB();

        $stmt = $db->prepare($sql);
        $stmt->execute($params ?? []);
        return $stmt;
    }
}
