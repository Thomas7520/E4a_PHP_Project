<?php

namespace Services;

use Models\User\User;
use Models\User\UserDAO;
use function Helpers\toast;

class AuthService
{
    public static function login(string $username, string $password): bool
    {
        $dao = new UserDAO();
        $user = $dao->getByUsername($username);



        if (!$user) return false;

        if (!password_verify($password, $user->getHashPwd())) return false;

        $_SESSION["userUID"] = $user->getId();
        $_SESSION["username"] = $user->getUsername();
        $_SESSION["timeout"] = time() + 60 * 30; // 5 minutes pour tester

        return true;
    }

    public static function logout(): void
    {
        unset($_SESSION["userUID"], $_SESSION["username"], $_SESSION["timeout"]);
    }

    public static function isLogged(): bool
    {

        return isset($_SESSION["userUID"]) && time() < ($_SESSION["timeout"] ?? 0);
    }

    /**
     * Crée un utilisateur en BD
     */
    public static function register(string $username, string $password): bool
    {
        $dao = new UserDAO();

        if ($dao->getByUsername($username)) {
            toast("L'identifiant existe déjà", "error");
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
