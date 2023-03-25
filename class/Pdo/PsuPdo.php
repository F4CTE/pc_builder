<?php 
namespace App\Psu;

use App\Parent\PdoDb;

class PsuPdo extends PdoDb {

    public function createDbItem(array $arrayItem): ?Psu
    {
        $psu = new Psu(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['watt'],
            array("pin_8" => $arrayItem['pin_8'] ?? 0, "pin_6" => $arrayItem['pin_6']?? 0),
            $arrayItem['size'] ?? null,
            $arrayItem['mpn'],
            $arrayItem['ean'],
            $arrayItem['image_url'] ?? null,
            null
        );
        $psu->save();
        return $psu;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM psus");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $psus = [];
        foreach ($rows as $row) {
            $psus[] = new Psu(
                $row['name'],
                $row['producer'],
                $row['power'],
                json_decode($row['connectics']),
                $row['format'],
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
        }
        return $psus;
    }

    public function getById(int $psuId): ?Psu
    {
        $stmt = $this->pdo->prepare("SELECT * FROM psus WHERE id=:id");
        $stmt->execute([
            ':id' => $psuId
        ]);
        $row = $stmt->fetch();
        return new Psu(
            $row['name'],
            $row['producer'],
            $row['power'],
            json_decode($row['connectics']),
            $row['format'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']

        );
    }

    public function create($psu): ?int
    {
        $stmt = $this->pdo->prepare("INSERT INTO psus (name,producer,power,connectics,format,mpn,ean,imageLink) VALUES (:name,:producer,:power,:connectics,:format,:mpn,:ean,:imageLink);");
        $stmt->execute([
            ':name' => $psu->getName(),
            ':producer' => $psu->getProducer(),
            ':power' => $psu->getPower(),
            ':connectics' => json_encode($psu->getConnectics()),
            ':format' => $psu->getFormat(),
            ':mpn' => $psu->getMpn(),
            ':ean' => $psu->getEan(),
            ':imageLink' => $psu->getImageLink()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($psu): bool
    {
        $stmt = $this->pdo->prepare("UPDATE psus SET name = :name, producer = :producer, power = :power, connectics = :connectics, format = :format, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id");
        $stmt->execute([
            ':name' => $psu->getName(),
            ':producer' => $psu->getProducer(),
            ':power' => $psu->getPower(),
            ':connectics' => json_encode($psu->getConnectics()),
            ':format' => $psu->getFormat(),
            ':mpn' => $psu->getMpn(),
            ':ean' => $psu->getEan(),
            ':imageLink' => $psu->getImageLink(),
            ':id' => $psu->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($psu): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM psus WHERE id = :id");
        $stmt->execute([
            ':id' => $psu->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function deleteAll(): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM psus");
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}