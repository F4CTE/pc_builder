<?php 
namespace App\Ram;

use App\Parent\PdoDb;

class RamPdo extends PdoDb {

    public function createDbItem(array $arrayItem): ?ram
    {
        $ram = new Ram(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['RAM_TYPE'],
            intval($arrayItem['size']),
            $arrayItem['clock'],
            $arrayItem['sticks'],
            $arrayItem['MPN'],
            $arrayItem['EAN'],
            $arrayItem['image_url'] ?? null,
            null
        );
        
        $ram->save();
        return $ram;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM rams");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $rams = [];
        foreach ($rows as $row) {
            $rams[] = new Ram(
                $row['name'],
                $row['producer'],
                $row['Type'],
                $row['capacity'],
                $row['clock'],
                $row['sticks'],
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
        }
        return $rams;
    }

    public function getById(int $ramId): ?Ram
    {
        $stmt = $this->pdo->prepare("SELECT * FROM rams WHERE id=:id");
        $stmt->execute([
            ':id' => $ramId
        ]);
        $row = $stmt->fetch();
        return new Ram(
            $row['name'],
            $row['producer'],
            $row['Type'],
            $row['capacity'],
            $row['clock'],
            $row['sticks'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function create($ram): ?int
    {
        $stmt = $this->pdo->prepare("INSERT INTO rams (name,producer,Type,capacity,clock,sticks,mpn,ean,imageLink) VALUES (:name,:producer,:Type,:capacity,:clock,:sticks,:mpn,:ean,:imageLink);");
        $stmt->execute([
            ':name' => $ram->getName(),
            ':producer' => $ram->getProducer(),
            ':Type' => $ram->getType(),
            ':capacity' => $ram->getSize(),
            ':clock' => $ram->getClock(),
            ':sticks' => $ram->getSticks(),
            ':mpn' => $ram->getMpn(),
            ':ean' => $ram->getEan(),
            ':imageLink' => $ram->getImageLink()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($ram): bool
    {
        $stmt = $this->pdo->prepare("UPDATE rams SET name = :name, producer = :producer, Type = :Type, capacity = :capacity, clock = :clock, sticks = :sticks, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id");
        $stmt->execute([
            ':name' => $ram->getName(),
            ':producer' => $ram->getProducer(),
            ':Type' => $ram->getType(),
            ':capacity' => $ram->getSize(),
            ':clock' => $ram->getClock(),
            ':sticks' => $ram->getSticks(),
            ':mpn' => $ram->getMpn(),
            ':ean' => $ram->getEan(),
            ':imageLink' => $ram->getImageLink(),
            ':id' => $ram->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($ram): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM rams WHERE id = :id");
        $stmt->execute([
            ':id' => $ram->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function deleteAll(): ?bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM rams");
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}