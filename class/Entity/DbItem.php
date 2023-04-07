<?php

namespace App\Parent;

abstract class DbItem
{
    protected ?int $id;
    protected ?PdoDb $pdo;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
        $this->createPdo();
    }

    final public function getId(): int
    {
        return $this->id;
    }

    final public function save()
    {
        $result = [];
        if (!is_null($this->id)) {
            $updateResult = $this->update();
            $result['status'] = $updateResult ? 'success' : 'error';
            if (!$updateResult) {
                $result['message'] = 'Update operation failed.';
            }
        } else {
            $insertResult = is_numeric($this->insert());
            $result['status'] = $insertResult ? 'success' : 'error';
            if (!$insertResult) {
                $result['message'] = 'Insert operation failed.';
            }
        }
        return $result;
    }


final public function destroy()
{
    $result = [];
    $deleteResult = $this->delete();
    if ($deleteResult) {
        unset($this->id);
        $result['status'] = 'success';
    } else {
        $result['status'] = 'error';
        $result['message'] = 'Delete operation failed.';
    }
    return $result;
}

    abstract protected function createPdo(): void;

    abstract protected function delete(): bool;

    abstract protected function insert(): int;

    abstract protected function update(): bool;
}
