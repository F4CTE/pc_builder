<?php
namespace App;
class HddPdo extends PdoDb
{
    public function createDbItem(array $arrayItem): Hdd
    {
        if ($arrayItem['producer'] == '3.5"' || $arrayItem['producer'] == '2.5"' || $arrayItem['producer'] == 'Link') {

            if (explode(' ', $arrayItem['name'])[0] == 'Western' || explode(' ', $arrayItem['name'])[0] == 'WD') {
                $arrayItem['producer'] = 'Western Digital';
            } else $arrayItem['producer'] = explode(' ', $arrayItem['name'])[0];
        }
        $hdd = new Hdd(
            $arrayItem['name'],
            $arrayItem['producer'],
            intval($arrayItem['size']) * 1000,
            intval($arrayItem['rpm']),
            $arrayItem['mpn'],
            $arrayItem['ean'],
            $arrayItem['image_url'] ?? null,
            null
        );
        $hdd->save();
        return $hdd;
        
    }

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

    public function getById(int $id): ?Hdd
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
            ':capacity' => $item->getSize(),
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
            ':capacity' => $item->getSize(),
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

    public function deleteAll(): ?bool
    {
        $query = "DELETE FROM hdds";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
