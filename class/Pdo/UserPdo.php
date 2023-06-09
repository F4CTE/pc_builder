<?php

namespace App\User;

use App\Parent\PdoDb;

class UserPdo extends PdoDb
{
    private const TABLE_NAME = 'users';
    private const UPDATE_QUERY = "UPDATE users SET username = :username, email = :email, password = :password, admin = :admin, banned = :banned WHERE id = :id";
    private const INSERT_QUERY = "INSERT INTO users (username,email,password,admin,banned) VALUES (:username,:email,:password,:admin,:banned)";

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::UPDATE_QUERY, self::INSERT_QUERY);
    }


    public function rowToObject(array|bool $row): User|bool
    {
        if (!$row) {
            return false;
        } else
            return new User(
                $row['username'],
                $row['email'],
                $row['password'],
                (bool) $row['admin'],
                $row['id'],
                (bool) $row['banned'] ?? false
            );
    }

    public function objectToRow($item): array
    {
        return [
            'username' => $item->getUsername(),
            'email' => $item->getEmail(),
            'password' => $item->getPassword(),
            'admin' => (bool) $item->isAdmin(),
            'banned' => (bool) $item->isBanned()
        ];
    }

    public function getByEmail(String $email): User|bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([
            ':email' => $email
        ]);
        $row = $stmt->fetch();
        return $this->rowToObject($row);
    }

    public function getByUsername(string $username): User|bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([
            ':username' => $username
        ]);
        $row = $stmt->fetch();
        return $this->rowToObject($row);
    }
}
