<?php

namespace App\User;

use App\Parent\DbItem;
use JsonSerializable;

class user extends DbItem implements JsonSerializable
{
    private string $username;
    private string $email;
    private ?string $password;
    private bool $admin;
    private bool $banned;

    public function __construct(
        string $username,
        string $email,
        ?string $password = null,
        ?bool $admin = false,
        ?int $id = null,
        ?bool $banned = false,
    ) {
        parent::__construct($id);
        $this->username = $username;
        $this->email = $email;
        $this->password = $password ?? null;
        $this->admin = $admin ?? false;
        $this->banned = $banned ?? false;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'admin' => $this->admin,
            'banned' => $this->banned
        ];
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
    public function isBanned(){
        return $this->banned;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->save();
        return $this;
    }

    public function isPasswordCorrect(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}
