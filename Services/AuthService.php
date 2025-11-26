<?php

namespace Services;

use Models\User\User;
use Models\User\UserDAO;
use function Helpers\toast;

/**
 * Handles user authentication and registration.
 */
class AuthService
{
    /**
     * Attempt to log in a user with the given credentials.
     *
     * @param string $username Username.
     * @param string $password Plain-text password.
     * @return bool True if login is successful, false otherwise.
     */
    public static function login(string $username, string $password): bool
    {
        $dao = new UserDAO();
        $user = $dao->getByUsername($username);

        if (!$user) return false;

        if (!password_verify($password, $user->getHashPwd())) return false;

        $_SESSION["userUID"] = $user->getId();
        $_SESSION["username"] = $user->getUsername();
        $_SESSION["timeout"] = time() + 60 * 30; // session timeout in seconds (30 min)

        return true;
    }

    /**
     * Log out the current user by clearing session data.
     */
    public static function logout(): void
    {
        unset($_SESSION["userUID"], $_SESSION["username"], $_SESSION["timeout"]);
    }

    /**
     * Check if a user is currently logged in.
     *
     * @return bool True if a user session exists and is valid, false otherwise.
     */
    public static function isLogged(): bool
    {
        return isset($_SESSION["userUID"]) && time() < ($_SESSION["timeout"] ?? 0);
    }

    /**
     * Register a new user in the database.
     *
     * @param string $username Desired username.
     * @param string $password Plain-text password.
     * @return bool True if registration succeeds, false if username already exists.
     */
    public static function register(string $username, string $password): bool
    {
        $dao = new UserDAO();

        if ($dao->getByUsername($username)) {
            toast("Username already exists", "error");
            return false;
        }

        $user = new User(
            null,
            $username,
            password_hash($password, PASSWORD_DEFAULT)
        );

        return $dao->createUser($user->getUsername(), $user->getHashPwd());
    }
}
