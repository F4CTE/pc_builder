<?php
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/build.php';
require_once __DIR__ . '/Chassis.php';
require_once __DIR__ . '/Cpu.php';
require_once __DIR__ . '/CpuCooler.php';
require_once __DIR__ . '/Gpu.php';
require_once __DIR__ . '/Hdd.php';
require_once __DIR__ . '/Psu.php';
require_once __DIR__ . '/Ram.php';
require_once __DIR__ . '/Ssd.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/../.env');

class ObjectToDb
{
    private pdo $pdo;
    private string $dsn;
    const options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    public function __construct()
    {
        $this->dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=' . $_ENV['DB_CHARSET'];
        try {
            $this->pdo = new PDO($this->dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $this::options);
        } catch (PDOException $e) {
            die('Une erreur est survenue : ' . $e->getCode() . '-' . $e->getMessage());
        };
    }

    public function getUserById(int $id): User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute([
            ':id' => $id
        ]);
        $row = $stmt->fetch();
        return new User(
            $row['username'],
            $row['email'],
            $row['password'],
            $row['admin'],
            $row['id']
        );
    }

    public function getUserByEmail(String $email): User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute([
            ':email' => $email
        ]);
        $row = $stmt->fetch();
        return new User(
            $row['username'],
            $row['email'],
            $row['password'],
            $row['admin'],
            $row['id']
        );
    }

    public function newUser(User $user): bool
    {
        if (!is_null($user['id'])) {
            return false;
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO users (username,email,password,admin) VALUES (:id,:username,:email,:password,:admin);");
            $stmt->execute([
                ':username' => $user['username'],
                ':email' => $user['email'],
                ':password' => $user['password'],
                ':admin' => $user['admoin']
            ]);
            $stmt->fetch();
        };
    }


    public function getUserByUsername(string $username): User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username=:username");
        $stmt->execute([
            ':username' => $username
        ]);
        $row = $stmt->fetch();
        return new User(
            $row['username'],
            $row['email'],
            $row['password'],
            $row['admin'],
            $row['id']
        );
    }

    public function getBuildById(int $buildId): Build
    {
        $stmt = $this->pdo->prepare("SELECT * FROM builds WHERE id=:id");
        $stmt->execute([
            ':id' => $buildId
        ]);
        $row = $stmt->fetch();
        return new Build(
            $row['user_id'],
            $row['name'],
            json_decode($row['parts']),
            $row['id']
        );
    }

    public function getChassisById(int $chassisId): Chassis
    {
        $stmt = $this->pdo->prepare("SELECT * FROM chassis WHERE id=:id");
        $stmt->execute([
            ':id' => $chassisId
        ]);
        $row = $stmt->fetch();
        return new Chassis(
            $row['name'],
            $row['producer'],
            $row['mbFormat'],
            $row['psu'],
            $row['maxGpuSize'],
            $row['maxCpuCoolerHeight'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id'],
        );
    }

    public function getCpuById(int $cpuId): Cpu
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cpus WHERE id=:id");
        $stmt->execute([
            ':id' => $cpuId
        ]);
        $row = $stmt->fetch();
        return new Cpu(
            $row['name'],
            $row['producer'],
            $row['baseClock'],
            $row['turboClock'],
            $row['cores'],
            $row['threads'],
            $row['socket'],
            $row['tdp'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id'],
        );
    }

    public function getCpuCoolerById(int $cpuCoolerId): CpuCooler
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cpu_cooler WHERE id=:id");
        $stmt->execute([
            ':id' => $cpuCoolerId
        ]);
        $row = $stmt->fetch();
        return new CpuCooler(
            $row['name'],
            $row['producer'],
            $row['height'],
            json_decode($row['sockets']),
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function getGpuById(int $gpuId): Gpu
    {
        $stmt = $this->pdo->prepare("SELECT * FROM gpus WHERE id=:id");
        $stmt->execute([
            ':id' => $gpuId
        ]);
        $row = $stmt->fetch();
        return new Gpu(
            $row['name'],
            $row['producer'],
            $row['boostClock'],
            $row['vram'],
            $row['memoryClock'],
            $row['length'],
            json_decode($row['powerSupply']),
            $row['tdp'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id'],
        );
    }

    public function getHddById(int $hddId): Hdd
    {
        $stmt = $this->pdo->prepare("SELECT * FROM hdds WHERE id=:id");
        $stmt->execute([
            ':id' => $hddId
        ]);
        $row = $stmt->fetch();
        return new Hdd(
            $row['name'],
            $row['producer'],
            $row['capacity'],
            $row['rpm'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id'],
        );
    }

    public function getPsuById(int $psuId): Psu
    {
        $stmt = $this->pdo->prepare("SELECT * FROM psus WHERE id=:id");
        $stmt->execute([
            ':id' => $psuId
        ]);
        $row = $stmt->fetch();
        return new Psu(
            $row['name'],
            $row['producer'],
            $row['power'],
            json_decode($row['connectics']),
            $row['format'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']

        );
    }

    public function getRamById(int $ramId): Ram
    {
        $stmt = $this->pdo->prepare("SELECT * FROM rams WHERE id=:id");
        $stmt->execute([
            ':id' => $ramId
        ]);
        $row = $stmt->fetch();
        return new Ram(
            $row['name'],
            $row['producer'],
            $row['power'],
            $row['connectics'],
            $row['format'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function getSsdById(int $ssdId): Ssd
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
}
