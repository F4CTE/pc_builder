<?php
namespace App;
class BuildPdo extends PdoDb {
    public function getAll(): array
    {
        $sql = 'SELECT * FROM builds';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $builds = $stmt->fetchAll();
        $buildsArray = [];
        foreach ($builds as $build) {
            $buildsArray[] = new Build(
                $build['user_id'],
                $build['name'],
                json_decode($build['parts']),
                $build['id']
            );
        }
        return $buildsArray;
    }

    public function getById(int $id): ?object
    {
        $sql = 'SELECT * FROM builds WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return new Build(
            $row['user_id'],
            $row['name'],
            json_decode($row['parts']),
            $row['id']
        );
    }

    public function create($item): ?int
    {
        $sql = 'INSERT INTO builds (user_id, name, parts) VALUES (:user_id, :name, :parts)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $item->getUserId(),
            ':name' => $item->getName(),
            ':parts' => json_encode($item->getParts())
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($item): ?bool
    {
        $sql = 'UPDATE builds SET user_id = :user_id, name = :name, parts = :parts WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $item->getUserId(),
            ':name' => $item->getName(),
            ':parts' => json_encode($item->getParts()),
            ':id' => $item->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($item): ?bool
    {
        $sql = 'DELETE FROM builds WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $item->getId()]);
        return $stmt->rowCount() > 0;
    }
}