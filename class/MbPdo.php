<?php
namespace App;
class MbPdo extends PdoDb
{
    public function getById(int $id): ?Mb
    {
        $query = "SELECT * FROM motherboards WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return new Mb(
            $row['name'],
            $row['producer'],
            $row['socket'],
            $row['chipset'],
            $row['form'],
            $row['memoryType'],
            json_decode($row['ports']),
            $row['memoryCapacity'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );

    }

    public function getAll(): array
    {
        $query = "SELECT * FROM motherboards";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $motherboards = [];
        foreach ($rows as $row) {
            $motherboards[] = new Mb(
                $row['name'],
                $row['producer'],
                $row['socket'],
                $row['chipset'],
                $row['form'],
                $row['memoryType'],
                json_decode($row['ports']),
                $row['memoryCapacity'],
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
        }
        return $motherboards;
    }

    public function create($item): ?int
    {
        $query = "INSERT INTO motherboards (name, producer, socket, chipset, form, memoryType, ports, memoryCapacity, mpn, ean, imageLink) VALUES (:name, :producer, :socket, :chipset, :form, :memoryType, :ports, :memoryCapacity, :mpn, :ean, :imageLink)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':socket' => $item->getSocket(),
            ':chipset' => $item->getChipset(),
            ':form' => $item->getForm(),
            ':memoryType' => $item->getMemoryType(),
            ':ports' => json_encode($item->getPorts()),
            ':memoryCapacity' => $item->getMemoryCapacity(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($item): ?bool
    {
        $query = "UPDATE motherboards SET name = :name, producer = :producer, socket = :socket, chipset = :chipset, form = :form, memoryType = :memoryType, ports = :ports, memoryCapacity = :memoryCapacity, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':socket' => $item->getSocket(),
            ':chipset' => $item->getChipset(),
            ':form' => $item->getForm(),
            ':memoryType' => $item->getMemoryType(),
            ':ports' => json_encode($item->getPorts()),
            ':memoryCapacity' => $item->getMemoryCapacity(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink(),
            ':id' => $item->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($item): ?bool
    {
        $query = "DELETE FROM motherboards WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $item->getId()]);
        return $stmt->rowCount() > 0;
    }
}   