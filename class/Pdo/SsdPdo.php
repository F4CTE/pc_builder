<?php

namespace App\Ssd;

use App\Parent\PdoDb;

class SsdPdo extends PdoDb
{

    public function createDbItem(array $arrayItem): Ssd
    {
        $ssd = new Ssd(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['form'],
            $arrayItem['protocol'],
            intval($arrayItem['size']),
            $arrayItem['controller'] ?? null,
            $arrayItem['nand'] ?? null,
            $arrayItem['mpn'],
            $arrayItem['ean'],
            $arrayItem['image_url'] ?? null,
            null
        );
        $ssd->save();
        return $ssd;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM ssds");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $ssds = [];
        foreach ($rows as $row) {
            $ssds[] = new Ssd(
                $row['name'],
                $row['producer'],
                $row['form'],
                $row['protocol'],
                $row['storage'],
                $row['controller'],
                $row['nand'],
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
        }
        return $ssds;
    }

    public function getById(int $ssdId): ?Ssd
    {
        $stmt = $this->pdo->prepare("SELECT * FROM ssds WHERE id=:id");
        $stmt->execute([
            ':id' => $ssdId
        ]);
        $row = $stmt->fetch();
        return new Ssd(
            $row['name'],
            $row['producer'],
            $row['form'],
            $row['protocol'],
            $row['storage'],
            $row['controller'],
            $row['nand'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function create($ssd): ?int
    {
        $stmt = $this->pdo->prepare("INSERT INTO ssds (name, producer, form, protocol, capacity, controller, nand, mpn, ean, imageLink) VALUES (:name, :producer, :form, :protocol, :capacity, :controller, :nand, :mpn, :ean, :imageLink)");
        $stmt->execute([
            ':name' => $ssd->getName(),
            ':producer' => $ssd->getProducer(),
            ':form' => $ssd->getForm(),
            ':protocol' => $ssd->getProtocol(),
            ':capacity' => $ssd->getSize(),
            ':controller' => $ssd->getController(),
            ':nand' => $ssd->getNand(),
            ':mpn' => $ssd->getMpn(),
            ':ean' => $ssd->getEan(),
            ':imageLink' => $ssd->getImageLink()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($ssd): bool
    {
        $stmt = $this->pdo->prepare("UPDATE ssds SET name = :name, producer = :producer, form = :form, protocol = :protocol, storage = :storage, controller = :controller, nand = :nand, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id");
        $stmt->execute([
            ':name' => $ssd->getName(),
            ':producer' => $ssd->getProducer(),
            ':form' => $ssd->getForm(),
            ':protocol' => $ssd->getProtocol(),
            ':storage' => $ssd->getSize(),
            ':controller' => $ssd->getController(),
            ':nand' => $ssd->getNand(),
            ':mpn' => $ssd->getMpn(),
            ':ean' => $ssd->getEan(),
            ':imageLink' => $ssd->getImageLink(),
            ':id' => $ssd->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($ssd): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM ssds WHERE id = :id");
        $stmt->execute([
            ':id' => $ssd->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    public function deleteAll(): ?bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM ssds");
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
