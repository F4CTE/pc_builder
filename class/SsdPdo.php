<?php
namespace App;
class SsdPdo extends PdoDb {

    public function getAll() : array {
        $stmt = $this->pdo->prepare("SELECT * FROM ssds");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $ssds = [];
        foreach ($rows as $row) {
            $ssds[] = new Ssd(
                $row['name'],
                $row['producer'],
                $row['form'],
                $row['protocol'],
                $row['storage'],
                $row['controller'],
                $row['nand'],
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
        }
        return $ssds;
    }

    public function getById(int $ssdId): ?Ssd
    {
        $stmt = $this->pdo->prepare("SELECT * FROM ssds WHERE id=:id");
        $stmt->execute([
            ':id' => $ssdId
        ]);
        $row = $stmt->fetch();
        return new Ssd(
            $row['name'],
            $row['producer'],
            $row['form'],
            $row['protocol'],
            $row['storage'],
            $row['controller'],
            $row['nand'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function create($ssd): ?int
    {
            $stmt = $this->pdo->prepare("INSERT INTO ssd (name,capacity,price) VALUES (:name,:capacity,:price);");
            $stmt->execute([
                ':name' => $ssd->getName(),
                ':capacity' => $ssd->getCapacity(),
                ':price' => $ssd->getPrice()
            ]);
            return $this->pdo->lastInsertId();
    }

    public function update($ssd): bool
    {
        $stmt = $this->pdo->prepare("UPDATE ssd SET name = :name, capacity = :capacity, price = :price WHERE id = :id");
        $stmt->execute([
            ':name' => $ssd->getName(),
            ':capacity' => $ssd->getCapacity(),
            ':price' => $ssd->getPrice(),
            ':id' => $ssd->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($ssd): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM ssd WHERE id = :id");
        $stmt->execute([
            ':id' => $ssd->getId()
        ]);
        return $stmt->rowCount() > 0;
    }
}