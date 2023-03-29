<?php

namespace App\Build;

use App\Chassis\Chassis;
use App\Chassis\ChassisPdo;
use App\Cpu\Cpu;
use App\Cpu\CpuPdo;
use App\CpuCooler\CpuCooler;
use App\CpuCooler\CpuCoolerPdo;
use App\Gpu\Gpu;
use App\Gpu\GpuPdo;
use App\Hdd\Hdd;
use App\Hdd\HddPdo;
use App\Mb\Mb;
use App\Mb\MbPdo;
use App\Parent\DbItem;
use App\Parent\Part;
use App\Psu\Psu;
use App\Psu\PsuPdo;
use App\Ram\Ram;
use App\Ram\RamPdo;
use App\Ssd\Ssd;
use App\Ssd\SsdPdo;

class build extends DbItem
{
    private ?int $userId = null;
    private ?string $name = null;
    private array $parts = [
        'cpu' => null,
        'cpuCooler' => null,
        'motherboard' => null,
        'rams' => [],
        'gpus' => [],
        'psu' => null,
        'case' => null,
        'hdds' => [],
        'ssds' => [],
    ];

    public function __construct(
        ?int $userId = null,
        ?string $name = null,
        ?array $parts = null,
        ?int $id = null,
    ) {
        parent::__construct($id);
        $this->userId = $userId;
        $this->name = $name;
        $this->parts = $parts ?? $this->parts;
    }

    protected function createPdo(): void
    {
        $this->pdo = new BuildPdo();
    }

    protected function insert(): int
    {
        return $this->pdo->create($this);
    }

    protected function update(): bool
    {
        return $this->pdo->update($this);
    }

    protected function delete(): bool
    {
        return $this->pdo->delete($this);
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParts(): array
    {
        return $this->parts;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCpu(int|Cpu $cpuId): void
    {
        if ($cpuId instanceof Cpu) {
            $this->parts['cpu'] = $cpuId->getId();
        } else {
            $this->parts['cpu'] = $cpuId;
        }
    }

    public function setIndividualPart(string $key, int|Part $part): void
    {
        if ($part instanceof Part) {
            $this->parts[$key] = $part->getId();
        } else {
            $this->parts[$key] = $part;
        }
    }

    public function setCpuCooler(int|CpuCooler $cpuCoolerId): void
    {
        if ($cpuCoolerId instanceof CpuCooler) {
            $this->parts['cpuCooler'] = $cpuCoolerId->getId();
        } else {
            $this->parts['cpuCooler'] = $cpuCoolerId;
        }
    }

    public function setMotherboard(int $motherboardId): void
    {
        if ($motherboardId instanceof Mb) {
            $this->parts['motherboard'] = $motherboardId->getId();
        } else {
            $this->parts['motherboard'] = $motherboardId;
        }
    }

    public function setRams(array $ramIds): void
    {
        if ($ramIds[0] instanceof Ram) {
            $this->parts['rams'] = array_map(fn ($ram) => $ram->getId(), $ramIds);
        } else {
            $this->parts['rams'] = $ramIds;
        }
    }

    public function addRam(int|Ram $ramId): void
    {
        if ($ramId instanceof Ram) {
            $this->parts['rams'][] = $ramId->getId();
        } else {
            $this->parts['rams'][] = $ramId;
        }
    }

    public function setGpus(array $gpuIds): void
    {
        if ($gpuIds[0] instanceof Gpu) {
            $this->parts['gpus'] = array_map(fn ($gpu) => $gpu->getId(), $gpuIds);
        } else {
            $this->parts['gpus'] = $gpuIds;
        }
    }

    public function addGpu(int|Gpu $gpuId): void
    {
        if ($gpuId instanceof Gpu) {
            $this->parts['gpus'][] = $gpuId->getId();
        } else {
            $this->parts['gpus'][] = $gpuId;
        }
    }



    public function setPsu(int|Psu $psuId): void
    {
        if ($psuId instanceof Psu) {
            $this->parts['psu'] = $psuId->getId();
        } else {
            $this->parts['psu'] = $psuId;
        }
    }

    public function setCase(int|Chassis $caseId): void
    {
        if ($caseId instanceof Chassis) {
            $this->parts['case'] = $caseId->getId();
        } else {
            $this->parts['case'] = $caseId;
        }
    }

    public function setHdds(array $hddIds): void
    {
        if ($hddIds[0] instanceof Hdd) {
            $this->parts['hdds'] = array_map(fn ($hdd) => $hdd->getId(), $hddIds);
        } else {
            $this->parts['hdds'] = $hddIds;
        }
    }

    public function addHdd(int|Hdd $hddId): void
    {
        if ($hddId instanceof Hdd) {
            $this->parts['hdds'][] = $hddId->getId();
        } else {
            $this->parts['hdds'][] = $hddId;
        }
    }

    public function setSsds(array $ssdIds): void
    {
        if ($ssdIds[0] instanceof Ssd) {
            $this->parts['ssds'] = array_map(fn ($ssd) => $ssd->getId(), $ssdIds);
        } else {
            $this->parts['ssds'] = $ssdIds;
        }
    }

    public function addSsd(int|Ssd $ssdId): void
    {
        if ($ssdId instanceof Ssd) {
            $this->parts['ssds'][] = $ssdId->getId();
        } else {
            $this->parts['ssds'][] = $ssdId;
        }
    }

    public function getCpu(): ?Cpu
    {
        if ($this->parts['cpu'] === null) {
            return null;
        }
        return (new CpuPdo())->getById($this->parts['cpu']);
    }

    public function getCpuCooler(): ?CpuCooler
    {
        if ($this->parts['cpuCooler'] === null) {
            return null;
        }
        return (new CpuCoolerPdo())->getById($this->parts['cpuCooler']);
    }

    public function getMotherboard(): ?Mb
    {
        if ($this->parts['motherboard'] === null) {
            return null;
        }
        return (new MbPdo())->getById($this->parts['motherboard']);
    }

    public function getRams(): array
    {
        if ($this->parts['rams'] === null) {
            return [];
        }
        return (new RamPdo())->getByIds($this->parts['rams']);
    }

    public function getGpus(): array
    {
        if ($this->parts['gpus'] === null) {
            return [];
        }
        return (new GpuPdo())->getByIds($this->parts['gpus']);
    }

    public function getPsu(): ?Psu
    {
        if ($this->parts['psu'] === null) {
            return null;
        }
        return (new PsuPdo())->getById($this->parts['psu']);
    }

    public function getCase(): ?Chassis
    {
        if ($this->parts['case'] === null) {
            return null;
        }
        return (new ChassisPdo())->getById($this->parts['case']);
    }

    public function getHdds(): array
    {
        if ($this->parts['hdds'] === null) {
            return [];
        }
        return (new HddPdo())->getByIds($this->parts['hdds']);
    }

    public function getSsds(): array
    {
        if ($this->parts['ssds'] === null) {
            return [];
        }
        return (new SsdPdo())->getByIds($this->parts['ssds']);
    }
}
