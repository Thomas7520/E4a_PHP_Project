<?php
namespace Models;

use Exception;
use PDO;

class BasePDODAO {
    protected static ?array $param = null;
    protected ?PDO $db = null;

    protected static function getParameter(): array {
        if (self::$param === null) {
            $cheminFichier = __DIR__ . '/../Config/dev.ini';
            if (!file_exists($cheminFichier)) {
                $cheminFichier = __DIR__ . '/../Config/dev_sample.ini';
            }
            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé");
            }
            self::$param = parse_ini_file($cheminFichier);
        }
        return self::$param;
    }

    protected function getDB(): PDO {
        if ($this->db === null) {
            $params = self::getParameter();
            $this->db = new PDO(
                $params['dsn'],
                $params['user'],
                $params['pass']
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->db;
    }

    protected function execRequest(string $sql, ?array $params = null) {
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute($params ?? []);
        return $stmt;
    }
}
