<?php

namespace Models\User;

/**
 * Represents a User in the system.
 */
class User
{
    private ?int $id;
    private string $username;
    private string $hashPwd;

    /**
     * Constructor.
     *
     * @param int|null $id Optional user ID.
     * @param string $username Username of the user.
     * @param string $hashPwd Hashed password.
     */
    public function __construct(?int $id, string $username, string $hashPwd)
    {
        $this->id = $id;
        $this->username = $username;
        $this->hashPwd = $hashPwd;
    }

    /**
     * Get the user ID.
     *
     * @return int|null User ID or null if not set.
     */
    public function getId(): ?int { return $this->id; }

    /**
     * Get the username.
     *
     * @return string Username.
     */
    public function getUsername(): string { return $this->username; }

    /**
     * Get the hashed password.
     *
     * @return string Hashed password.
     */
    public function getHashPwd(): string { return $this->hashPwd; }
}
