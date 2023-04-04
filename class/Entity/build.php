<?php

namespace App\Build;
use App\Chassis\ChassisPdo;
use App\Cpu\CpuPdo;
use App\CpuCooler\CpuCoolerPdo;
use App\Gpu\GpuPdo;
use App\Hdd\HddPdo;
use App\Mb\MbPdo;
use App\Parent\DbItem;
use App\Parent\Part;
use App\Psu\PsuPdo;
use App\Ram\RamPdo;
use App\Ssd\SsdPdo;

class Build extends DbItem
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


    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setIndividualPart(string $key, int|Part|array $part): void
    {
        if (!array_key_exists($key, $this->parts)) {
            return;
        }

        if (is_array($part)) {
            if ($part[0] instanceof Part) {
                $this->parts[$key] = array_map(fn ($p) => $p->getId(), $part);
            } else {
                $this->parts[$key] = $part;
            }
        } else {
            if ($part instanceof Part) {
                $this->parts[$key] = $part->getId();
            } else {
                $this->parts[$key] = $part;
            }
        }
    }

    
    public function getPart(string $key, bool $id = false): Part|array|null|int
    {
        if (!array_key_exists($key, $this->parts) || $this->parts[$key] === null) {
            return null;
        }
        switch ($key) {
            case 'cpu':
                if ($id) {
                    return $this->parts['cpu'];
                } else
                    return (new CpuPdo())->getById($this->parts['cpu']);
                break;
            case 'cpuCooler':
                if ($id) {
                    return $this->parts['cpuCooler'];
                } else
                return (new CpuCoolerPdo())->getById($this->parts['cpuCooler']);
                break;
            case 'motherboard':
                if ($id) {
                    return $this->parts['motherboard'];
                } else
                return (new MbPdo())->getById($this->parts['motherboard']);
                break;
            case 'psu':
                if ($id) {
                    return $this->parts['psu'];
                } else
                return (new PsuPdo())->getById($this->parts['psu']);
                break;
            case 'case':
                if ($id) {
                    return $this->parts['case'];
                } else
                return (new ChassisPdo())->getById($this->parts['case']);
                break;
            case 'rams':
                if ($id) {
                    return $this->parts['rams'];
                } else
                return (new RamPdo())->getByIds($this->parts['rams']);
                break;
            case 'gpus':
                if ($id) {
                    return $this->parts['gpus'];
                } else
                return (new GpuPdo())->getByIds($this->parts['gpus']);
                break;
            case 'hdds':
                if ($id) {
                    return $this->parts['hdds'];
                } else
                return (new HddPdo())->getByIds($this->parts['hdds']);
                break;
            case 'ssds':
                if ($id) {
                    return $this->parts['ssds'];
                } else
                return (new SsdPdo())->getByIds($this->parts['ssds']);
            default:
                return null;
                break;
        }
    }
}
