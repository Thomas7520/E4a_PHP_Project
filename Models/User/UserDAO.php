<?php

namespace Models\User;

use Models\BasePDODAO;
use PDO;

/**
 * Data Access Object for User entities.
 * Handles retrieval and creation of users in the database.
 */
class UserDAO extends BasePDODAO
{
    /**
     * Retrieve a user by their username.
     *
     * @param string $username The username to search for.
     * @return User|null Returns a User object if found, or null otherwise.
     */
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

    /**
     * Create a new user in the database.
     *
     * @param string $username The username of the new user.
     * @param string $password The hashed password for the new user.
     * @return bool True on success, false on failure.
     */
    public function createUser(string $username, string $password): bool
    {
        $sql = "INSERT INTO users (username, hash_pwd) VALUES (?, ?)";
        $stmt = $this->execRequest($sql, [$username, $password]);

        return $stmt !== false;
    }
}
