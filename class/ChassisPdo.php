<?php
namespace App;
class ChassisPdo extends PdoDb {
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
                $row['psuFormat'],
                $row['maxGpuSize'],
                $row['maxCpuCoolerHeight'],
                $row['mpn'],
                $row['ean'],
                $row['image_url'],
                $row['id']
            );
        }
        return $chassis;
    }

    public function getById(int $id): ?object
    {
        $sql = 'SELECT * FROM chassis WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return new Chassis(
            $row['name'],
            $row['producer'],
            $row['mbFormat'],
            $row['psuFormat'],
            $row['maxGpuSize'],
            $row['maxCpuCoolerHeight'],
            $row['mpn'],
            $row['ean'],
            $row['image_url'],
            $row['id']
        );
    }

    public function create($item): ?int
    {
        $sql = 'INSERT INTO chassis (name, producer, mbFormat, psuFormat, maxGpuSize, maxCpuCoolerHeight, mpn, ean, image_url) VALUES (:name, :producer, :mbFormat, :psuFormat, :maxGpuSize, :maxCpuCoolerHeight, :mpn, :ean, :image_url)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':mbFormat' => $item->getMbFormat(),
            ':psuFormat' => $item->getPsuFormat(),
            ':maxGpuSize' => $item->getMaxGpuSize(),
            ':maxCpuCoolerHeight' => $item->getMaxCpuCoolerHeight(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':image_url' => $item->getImageLink()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($item): ?bool
    {
        $sql = 'UPDATE chassis SET name = :name, producer = :producer, mbFormat = :mbFormat, psuFormat = :psuFormat, maxGpuSize = :maxGpuSize, maxCpuCoolerHeight = :maxCpuCoolerHeight, mpn = :mpn, ean = :ean, image_url = :image_url WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':mbFormat' => $item->getMbFormat(),
            ':psuFormat' => $item->getPsuFormat(),
            ':maxGpuSize' => $item->getMaxGpuSize(),
            ':maxCpuCoolerHeight' => $item->getMaxCpuCoolerHeight(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':image_url' => $item->getImageLink(),
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
}