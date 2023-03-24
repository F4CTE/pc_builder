<?php
namespace App;

class CpuPdo extends PdoDb {
    public function getAll(): array
    {
        $sql = 'SELECT * FROM cpu';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $cpuList = [];
        foreach ($result as $cpu) {
            $cpuList[] = new Cpu(
                $cpu['name'],
                $cpu['producer'],
                floatval($cpu['base_clock']),
                floatval($cpu['turbo_clock']),
                intval($cpu['cores']),
                intval($cpu['threads']),
                $cpu['socket'],
                intval($cpu['tdp']),
                $cpu['mpn'],
                $cpu['ean'],
                $cpu['image_link'],
                intval($cpu['id']),
            );
        }
        return $cpuList;
    }

    public function getById(int $id): ?object
    {
        $sql = 'SELECT * FROM cpu WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $cpu = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new Cpu(
            $cpu['name'],
            $cpu['producer'],
            floatval($cpu['base_clock']),
            floatval($cpu['turbo_clock']),
            intval($cpu['cores']),
            intval($cpu['threads']),
            $cpu['socket'],
            intval($cpu['tdp']),
            $cpu['mpn'],
            $cpu['ean'],
            $cpu['image_link'],
            intval($cpu['id']),
        );
    }

    public function create ($item): ?int
    {
        $sql = 'INSERT INTO cpu (name, producer, base_clock, turbo_clock, cores, threads, socket, tdp, mpn, ean, image_link) VALUES (:name, :producer, :base_clock, :turbo_clock, :cores, :threads, :socket, :tdp, :mpn, :ean, :image_link)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':base_clock' => $item->getBaseClock(),
            ':turbo_clock' => $item->getTurboClock(),
            ':cores' => $item->getCores(),
            ':threads' => $item->getThreads(),
            ':socket' => $item->getSocket(),
            ':tdp' => $item->getTdp(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':image_link' => $item->getImageLink(),
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($item): ?bool
    {
        $sql = 'UPDATE cpu SET name = :name, producer = :producer, base_clock = :base_clock, turbo_clock = :turbo_clock, cores = :cores, threads = :threads, socket = :socket, tdp = :tdp, mpn = :mpn, ean = :ean, image_link = :image_link WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':base_clock' => $item->getBaseClock(),
            ':turbo_clock' => $item->getTurboClock(),
            ':cores' => $item->getCores(),
            ':threads' => $item->getThreads(),
            ':socket' => $item->getSocket(),
            ':tdp' => $item->getTdp(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':image_link' => $item->getImageLink(),
            ':id' => $item->getId(),
        ]);
        return $stmt->rowCount() > 0;
    }

    public function delete($item): ?bool
    {
        $sql = 'DELETE FROM cpu WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $item->getId()]);
        return $stmt->rowCount() > 0;
    }
}