<?php
namespace App\Parent;

use App\Build\build;

abstract class PartPdo extends PdoDb {
    public function __construct($tableName, $updateQuery, $insertQuery)
    {
        parent::__construct($tableName, $updateQuery, $insertQuery);
    }

    abstract public function getCompatibleParts(build $build): array;

}