<?php

namespace App;

class CpuPdo extends PdoDb
{
    public function createDbItem(array $arrayItem): Cpu
    {
        $cpu = new Cpu(
            $arrayItem['name'],
            $arrayItem['Producer'],
            floatval($arrayItem['basse_clock']),
            floatval($arrayItem['turbo_clock']),
            $arrayItem['cores'],
            $arrayItem['threads'],
            $arrayItem['socket'],
            intval($arrayItem['TDP']),
            $arrayItem['MPN'],
            $arrayItem['EAN'],
            $arrayItem['cpu_image_link'] ?? null,
            null,
        );
        $cpu->save();
        return $cpu;
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM cpus';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $cpuList = [];
        foreach ($result as $cpu) {
            $cpuList[] = new Cpu(
                $cpu['name'],
                $cpu['producer'],
                floatval($cpu['baseClock']),
                floatval($cpu['turboClock']),
                intval($cpu['cores']),
                intval($cpu['threads']),
                $cpu['socket'],
                intval($cpu['tdp']),
                $cpu['mpn'],
                $cpu['ean'],
                $cpu['imageLink'],
                intval($cpu['id']),
            );
        }
        return $cpuList;
    }

    public function getById(int $id): ?Cpu
    {
        $sql = 'SELECT * FROM cpus WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $cpu = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new Cpu(
            $cpu['name'],
            $cpu['producer'],
            floatval($cpu['baseClock']),
            floatval($cpu['turboClock']),
            intval($cpu['cores']),
            intval($cpu['threads']),
            $cpu['socket'],
            intval($cpu['tdp']),
            $cpu['mpn'],
            $cpu['ean'],
            $cpu['imageLink'],
            intval($cpu['id']),
        );
    }

    public function create($item): ?int
    {
        $sql = 'INSERT INTO cpus (name, producer, baseClock, turboClock, cores, threads, socket, tdp, mpn, ean, imageLink) VALUES (:name, :producer, :baseClock, :turboClock, :cores, :threads, :socket, :tdp, :mpn, :ean, :imageLink)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':baseClock' => $item->getBaseClock(),
            ':turboClock' => $item->getTurboClock(),
            ':cores' => $item->getCores(),
            ':threads' => $item->getThreads(),
            ':socket' => $item->getSocket(),
            ':tdp' => $item->getTdp(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink(),
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($item): ?bool
    {
        $sql = 'UPDATE cpus SET name = :name, producer = :producer, baseClock = :baseClock, turboClock = :turboClock, cores = :cores, threads = :threads, socket = :socket, tdp = :tdp, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':baseClock' => $item->getBaseClock(),
            ':turboClock' => $item->getTurboClock(),
            ':cores' => $item->getCores(),
            ':threads' => $item->getThreads(),
            ':socket' => $item->getSocket(),
            ':tdp' => $item->getTdp(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink(),
            ':id' => $item->getId(),
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($item): ?bool
    {
        $sql = 'DELETE FROM cpus WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $item->getId()]);
        return $stmt->rowCount() > 0;
    }

    public function deleteAll(): ?bool
    {
        $sql = 'DELETE FROM cpus';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
