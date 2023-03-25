<?php

namespace App\User;

use App\Parent\DbItem;
use App\UserPdo;

class user extends DbItem
{
    private string $username;
    private string $email;
    private string $password;
    private bool $admin;

    public function __construct(
        string $username,
        string $email,
        string $password,
        ?bool $admin = false,
        ?int $id = null,
    ) {
        parent::__construct($id);
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->admin = $admin;
    }

    final protected function createPdo(): void
    {
        $this->pdo = new UserPdo();
    }

    final protected function insert(): int
    {
        return $this->pdo->create($this);
    }

    final protected function update(): bool
    {
        return $this->pdo->update($this);
    }

    final protected function delete(): bool
    {
        return $this->pdo->delete($this);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->save();
    }

    public function isPasswordCorrect(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}
