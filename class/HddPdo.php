<?php
namespace App;
class HddPdo extends PdoDb
{

    public function getAll(): array
    {
        $query = "SELECT * FROM hdds";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $hdds = [];
        foreach ($rows as $row) {
            $hdds[] = new Hdd(
                $row['name'],
                $row['producer'],
                $row['capacity'],
                $row['rpm'],
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
        }
        return $hdds;
    }

    public function getById(int $id): ?object
    {
        $query = "SELECT * FROM hdds WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return new Hdd(
            $row['name'],
            $row['producer'],
            $row['capacity'],
            $row['rpm'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function create($item): ?int
    {
        $query = "INSERT INTO hdds (name, producer, capacity, rpm, mpn, ean, imageLink) VALUES (:name, :producer, :capacity, :rpm, :mpn, :ean, :imageLink)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':capacity' => $item->getCapacity(),
            ':rpm' => $item->getRpm(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($item): ?bool
    {
        $query = "UPDATE hdds SET name = :name, producer = :producer, capacity = :capacity, rpm = :rpm, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':capacity' => $item->getCapacity(),
            ':rpm' => $item->getRpm(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink(),
            ':id' => $item->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($item): ?bool
    {
        $query = "DELETE FROM hdds WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $item->getId()]);
        return $stmt->rowCount() > 0;
    }
}
