<?php

namespace App\User;

use App\Parent\PdoDb;

class UserPdo extends PdoDb
{

    public function getAll(): array
    {
        $query = "SELECT * FROM users";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $users = [];
        foreach ($rows as $row) {
            $users[] = new User(
                $row['username'],
                $row['email'],
                $row['password'],
                $row['admin'],
                $row['id']
            );
        }
        return $users;
    }

    public function getById(int $id): ?User
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return new User(
            $row['username'],
            $row['email'],
            $row['password'],
            $row['admin'],
            $row['id']
        );
    }

    public function getByEmail(String $email): User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([
            ':email' => $email
        ]);
        $row = $stmt->fetch();
        return new User(
            $row['username'],
            $row['email'],
            $row['password'],
            $row['admin'],
            $row['id']
        );
    }

    public function getByUsername(string $username): User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([
            ':username' => $username
        ]);
        $row = $stmt->fetch();
        return new User(
            $row['username'],
            $row['email'],
            $row['password'],
            $row['admin'],
            $row['id']
        );
    }

    public function create($user): ?int
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (username,email,password,admin) VALUES (:username,:email,:password,:admin);");
        $stmt->execute([
            ':username' => $user->getUsername(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':admin' => $user->isAdmin()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($user): bool
    {
        $stmt = $this->pdo->prepare("UPDATE users SET username = :username, email = :email, password = :password, admin = :admin WHERE id = :id");
        $stmt->execute([
            ':username' => $user->getUsername(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':admin' => $user->isAdmin(),
            ':id' => $user->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($user): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([
            ':id' => $user->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function deleteAll(): ?bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users");
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
