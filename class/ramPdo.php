<?php 
namespace App;
class RamPdo extends PdoDb {

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
                $row['power'],
                $row['connectics'],
                $row['format'],
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
            $row['power'],
            $row['connectics'],
            $row['format'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function create($ram): ?int
    {
        $stmt = $this->pdo->prepare("INSERT INTO ram (name,producer,ram_type,size,clock,sticks,mpn,ean,image_url) VALUES (:name,:producer,:ram_type,:size,:clock,:sticks,:mpn,:ean,:image_url);");
        $stmt->execute([
            ':name' => $ram->getName(),
            ':producer' => $ram->getProducer(),
            ':ram_type' => $ram->getRamType(),
            ':size' => $ram->getSize(),
            ':clock' => $ram->getClock(),
            ':sticks' => $ram->getSticks(),
            ':mpn' => $ram->getMpn(),
            ':ean' => $ram->getEan(),
            ':image_url' => $ram->getImageLink()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($ram): bool
    {
        $stmt = $this->pdo->prepare("UPDATE ram SET name = :name, producer = :producer, ram_type = :ram_type, size = :size, clock = :clock, sticks = :sticks, mpn = :mpn, ean = :ean, image_url = :image_url WHERE id = :id");
        $stmt->execute([
            ':name' => $ram->getName(),
            ':producer' => $ram->getProducer(),
            ':ram_type' => $ram->getRamType(),
            ':size' => $ram->getSize(),
            ':clock' => $ram->getClock(),
            ':sticks' => $ram->getSticks(),
            ':mpn' => $ram->getMpn(),
            ':ean' => $ram->getEan(),
            ':image_url' => $ram->getImageLink(),
            ':id' => $ram->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($ram): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM ram WHERE id = :id");
        $stmt->execute([
            ':id' => $ram->getId()
        ]);
        return $stmt->rowCount() > 0;
    }
}