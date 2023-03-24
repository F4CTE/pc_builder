<?php
namespace App;

class GpuPdo extends PdoDb {

    public function getAll(): array
    {
        $query = "SELECT * FROM gpus";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $gpus = [];
        foreach ($rows as $row) {
            $gpus[] = new Gpu(
                $row['name'],
                $row['producer'],
                $row['BoostClock'],
                $row['vram'],
                $row['memoryClock'],
                $row['length'],
                $row['powerSupply'],
                $row['tdp'], 
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
        
        }
        return $gpus;
    }

    public function getById(int $id): ?object
    {
        $query = "SELECT * FROM gpus WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return new Gpu(
            $row['name'],
            $row['producer'],
            $row['BoostClock'],
            $row['vram'],
            $row['memoryClock'],
            $row['length'],
            $row['powerSupply'],
            $row['tdp'], 
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function create($item): ?int
    {
        $query = "INSERT INTO gpus (name, producer, BoostClock, vram, memoryClock, length, powerSupply, tdp, mpn, ean, imageLink) VALUES (:name, :producer, :BoostClock, :vram, :memoryClock, :length, :powerSupply, :tdp, :mpn, :ean, :imageLink)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':BoostClock' => $item->getBoostClock(),
            ':vram' => $item->getVram(),
            ':memoryClock' => $item->getMemoryClock(),
            ':length' => $item->getLength(),
            ':powerSupply' => $item->getPowerSupply(),
            ':tdp' => $item->getTdp(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($item): ?bool
    {
        $query = "UPDATE gpus SET name = :name, producer = :producer, BoostClock = :BoostClock, vram = :vram, memoryClock = :memoryClock, length = :length, powerSupply = :powerSupply, tdp = :tdp, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':BoostClock' => $item->getBoostClock(),
            ':vram' => $item->getVram(),
            ':memoryClock' => $item->getMemoryClock(),
            ':length' => $item->getLength(),
            ':powerSupply' => $item->getPowerSupply(),
            ':tdp' => $item->getTdp(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink(),
            ':id' => $item->getId()
        ]);
    }

    public function delete($item): ?bool
    {
        $query = "DELETE FROM gpus WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([':id' => $item->getId()]);
        
    }
}