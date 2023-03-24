<?php
namespace App;

class CpuCoolerPdo extends PdoDb {

    public function getAll(): array {
        $query = "SELECT * FROM cpu_cooler";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $cpuCoolers = [];
        foreach($rows as $row) {
            $cpuCoolers[] = new CpuCooler(
                $row['name'],
                $row['producer'],
                $row['height'],
                json_decode($row['sockets']),
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
        }
        return $cpuCoolers;

    }

    public function getById(int $id): ?object
    {
        $query = "SELECT * FROM cpu_cooler WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return new CpuCooler(
            $row['name'],
            $row['producer'],
            $row['height'],
            json_decode($row['sockets']),
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function create($item): ?int
    {
        $stmt = $this->pdo->prepare("INSERT INTO cpu_cooler (name, producer, height, sockets, mpn, ean, imageLink) VALUES (:name, :producer, :height, :sockets, :mpn, :ean, :imageLink)");
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':height' => $item->getHeight(),
            ':sockets' => json_encode($item->getSockets()),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($item): ?bool
    {
        $stmt = $this->pdo->prepare("UPDATE cpu_cooler SET name = :name, producer = :producer, height = :height, sockets = :sockets, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id");
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':height' => $item->getHeight(),
            ':sockets' => json_encode($item->getSockets()),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink(),
            ':id' => $item->getId()
        ]);
        return $stmt->rowCount() > 0;

    }

    public function delete($item): ?bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([
            ':id' => $item->getId()
        ]);
        return $stmt->rowCount() > 0;
    }
}