<?php

namespace Models\User;

use Models\BasePDODAO;
use PDO;

class UserDAO extends BasePDODAO
{
    public function getByUsername(string $username): ?User
    {
        $sql = "SELECT * FROM USERS WHERE username = ?";
        $stmt = $this->execRequest($sql, [$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        return new User(
            $row["id"],
            $row["username"],
            $row["hash_pwd"]
        );
    }

    public function createUser(string $username, string $password): bool
    {

        $sql = "INSERT INTO users (username, hash_pwd) VALUES (?, ?)";

        $stmt = $this->execRequest($sql, [$username, $password]);

        return $stmt !== false;
    }


}
