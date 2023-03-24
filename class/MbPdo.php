<?php
namespace App;
class MbPdo extends PdoDb
{
    public function createDbItem(array $arrayItem): ?Mb
    {
        $mb = new Mb(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['socket'],
            $arrayItem['chipset'],
            $arrayItem['form'],
            $arrayItem['memory_type'],
            array(
                'ram' => intval($arrayItem['ramslots'] ?? 0),
                'sata' => intval($arrayItem['sata'] ?? 0),
                'm2Pcie3' => intval($arrayItem['m2_pcie3'] ?? 0),
                'm2Pcie4' => intval($arrayItem['m2_pcie4'] ?? 0),
                'pcie3X1' => intval($arrayItem['pcie_3_x1'] ?? 0),
                'pcie3X16' => intval($arrayItem['pcie_3_x16'] ?? 0),
                'pcie4X1' => intval($arrayItem['pcie_4_x1'] ?? 0),
                'pcie4X16' => intval($arrayItem['pcie_4_x16'] ?? 0),
            ),
            $arrayItem['memory_capacity'] ?? null,
            $arrayItem['MPN'],
            $arrayItem['EAN'],
            $arrayItem['selection2'] ?? null,
            null
        );
        $mb->save();
        return $mb;
    }

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

    public function deleteAll(): ?bool
    {
        $query = "DELETE FROM motherboards";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

}   