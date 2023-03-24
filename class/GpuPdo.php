<?php
namespace App;

class GpuPdo extends PdoDb {

    public function createDbItem(array $arrayItem): Gpu
    {
        $gpu = new Gpu(
            $arrayItem['name'],
            $arrayItem['producer'],
            intval($arrayItem['boost_clock']),
            intval($arrayItem['vram']),
            intval($arrayItem['memory_clock']),
            intval($arrayItem['length']),
            array("pin_8" => intval($arrayItem['pin_8']), "pin_6" => intval($arrayItem['pin_6'])),
            intval($arrayItem['TDP']),
            $arrayItem['MPN'],
            $arrayItem['EAN'],
            $arrayItem['image_url'] ?? null,
            null
        );

        $gpu->save();
        return $gpu;
    }

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
                $row['boostClock'],
                $row['vram'],
                $row['memoryClock'],
                $row['length'],
                json_decode($row['powerSupply']),
                $row['tdp'], 
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
        
        }
        return $gpus;
    }

    public function getById(int $id): ?Gpu
    {
        $query = "SELECT * FROM gpus WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return new Gpu(
            $row['name'],
            $row['producer'],
            $row['boostClock'],
            $row['vram'],
            $row['memoryClock'],
            $row['length'],
            json_decode($row['powerSupply']),
            $row['tdp'], 
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function create($item): ?int
    {
        $query = "INSERT INTO gpus (name, producer, boostClock, vram, memoryClock, length, powerSupply, tdp, mpn, ean, imageLink) VALUES (:name, :producer, :boostClock, :vram, :memoryClock, :length, :powerSupply, :tdp, :mpn, :ean, :imageLink)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':boostClock' => $item->getBoostClock(),
            ':vram' => $item->getVram(),
            ':memoryClock' => $item->getMemoryClock(),
            ':length' => $item->getLength(),
            ':powerSupply' => json_encode($item->getPowerSupply()),
            ':tdp' => $item->getTdp(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($item): ?bool
    {
        $query = "UPDATE gpus SET name = :name, producer = :producer, boostClock = :boostClock, vram = :vram, memoryClock = :memoryClock, length = :length, powerSupply = :powerSupply, tdp = :tdp, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':boostClock' => $item->getBoostClock(),
            ':vram' => $item->getVram(),
            ':memoryClock' => $item->getMemoryClock(),
            ':length' => $item->getLength(),
            ':powerSupply' => json_encode($item->getPowerSupply()),
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

    public function deleteAll(): ?bool
    {
        $query = "DELETE FROM gpus";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute();
    }
}