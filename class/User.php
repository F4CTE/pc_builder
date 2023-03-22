<?php
require_once __DIR__ . '/DbItem.php';
class user extends DbItem{
    private string $username;
    private string $email;
    private string $password;
    private bool $admin;

    public function __construct(
        string $username,
        string $email,
        string $password,
        ?bool $admin = false,
        ?int $id = NULL,
    ) {
        parent::__construct($id ?? null);
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->admin = $admin ?? false;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function isPasswordCorrect(string $password): bool
    {
        return password_verify($password, $this->password);
    }

}