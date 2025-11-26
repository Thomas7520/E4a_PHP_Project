<?php

namespace Models\User;

class User
{
    private ?int $id;
    private string $username;
    private string $hashPwd;

    public function __construct(?int $id, string $username, string $hashPwd)
    {
        $this->id = $id;
        $this->username = $username;
        $this->hashPwd = $hashPwd;
    }

    public function getId(): int { return $this->id; }
    public function getUsername(): string { return $this->username; }
    public function getHashPwd(): string { return $this->hashPwd; }
}
