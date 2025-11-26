<?php
namespace Models;

use Exception;
use PDO;

/**
 * Base class for DAO classes using PDO.
 * Handles database connection and query execution.
 */
class BasePDODAO {
    /** @var array|null Cached configuration parameters */
    protected static ?array $param = null;

    /** @var PDO|null Database connection */
    protected ?PDO $db = null;

    /**
     * Load configuration parameters from the INI file.
     *
     * @return array Configuration parameters.
     * @throws Exception If no configuration file is found.
     */
    protected static function getParameter(): array {
        if (self::$param === null) {
            $cheminFichier = __DIR__ . '/../Config/dev.ini';
            if (!file_exists($cheminFichier)) {
                $cheminFichier = __DIR__ . '/../Config/dev_sample.ini';
            }
            if (!file_exists($cheminFichier)) {
                throw new Exception("No configuration file found");
            }
            self::$param = parse_ini_file($cheminFichier);
        }
        return self::$param;
    }

    /**
     * Get a PDO database connection.
     *
     * @return PDO The PDO instance.
     */
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

    /**
     * Prepare and execute a SQL statement.
     *
     * @param string $sql SQL query to execute.
     * @param array|null $params Optional parameters for prepared statement.
     * @return \PDOStatement The executed PDO statement.
     */
    protected function execRequest(string $sql, ?array $params = null) {
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute($params ?? []);
        return $stmt;
    }
}
