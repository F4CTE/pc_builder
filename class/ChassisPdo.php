<?php

namespace App;

class ChassisPdo extends PdoDb
{

    protected function createDbItem(array $arrayItem): ?Chassis
    {
        $chassis = new Chassis(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['Motherboard'],
            $arrayItem['Psu'] ?? $arrayItem['Motherboard'],
            intval($arrayItem['gpu_size']),
            intval($arrayItem['cpu_cooler_height']),
            $arrayItem['mpn'],
            $arrayItem['ean'],
            $arrayItem['image_url'] ?? null,
            null
        );
        $chassis->save();
        return $chassis;
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM chassis';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $chassis = [];
        foreach ($result as $row) {
            $chassis[] = new Chassis(
                $row['name'],
                $row['producer'],
                $row['mbFormat'],
                $row['psuFormat'] ?? $row['mbFormat'],
                $row['maxGpuSize'],
                $row['maxCpuCoolerHeight'],
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
        }
        return $chassis;
    }

    public function getById(int $id): ?Chassis
    {
        $sql = 'SELECT * FROM chassis WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return new Chassis(
            $row['name'],
            $row['producer'],
            $row['mbFormat'],
            $row['psuFormat'] ?? $row['mbFormat'],
            $row['maxGpuSize'],
            $row['maxCpuCoolerHeight'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function create($item): ?int
    {
        $sql = 'INSERT INTO chassis (name, producer, mbFormat, psuFormat, maxGpuSize, maxCpuCoolerHeight, mpn, ean, imageLink) VALUES (:name, :producer, :mbFormat, :psuFormat, :maxGpuSize, :maxCpuCoolerHeight, :mpn, :ean, :imageLink)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':mbFormat' => $item->getMbFormat(),
            ':psuFormat' => $item->getPsuFormat() ?? $item->getMbFormat(),
            ':maxGpuSize' => $item->getMaxGpuSize(),
            ':maxCpuCoolerHeight' => $item->getMaxCpuCoolerHeight(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($item): ?bool
    {
        $sql = 'UPDATE chassis SET name = :name, producer = :producer, mbFormat = :mbFormat, psuFormat = :psuFormat, maxGpuSize = :maxGpuSize, maxCpuCoolerHeight = :maxCpuCoolerHeight, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':mbFormat' => $item->getMbFormat(),
            ':psuFormat' => $item->getPsuFormat() ?? $item->getMbFormat(),
            ':maxGpuSize' => $item->getMaxGpuSize(),
            ':maxCpuCoolerHeight' => $item->getMaxCpuCoolerHeight(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink(),
            ':id' => $item->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($item): ?bool
    {
        $sql = 'DELETE FROM chassis WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $item->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function deleteAll(): ?bool
    {
        $sql = 'DELETE FROM chassis';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
