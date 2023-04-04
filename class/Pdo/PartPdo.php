<?php
namespace App\Parent;

use App\Build\build;

abstract class PartPdo extends PdoDb {
    protected $baseQuery;
    public function __construct($tableName, $updateQuery, $insertQuery)
    {
        $this->baseQuery = 'SELECT * FROM '.$tableName;
        parent::__construct($tableName, $updateQuery, $insertQuery);
    }

    final public function getCompatibleParts(Build $build): array
    {
        if (!$build) {
            return [];
        }
    
        $conditions = $this->getCompatibilityQuery($build);
    
        if (count($conditions) > 0) {
            $this->baseQuery .= " WHERE " . implode(' AND ', $conditions);
        }
    
        $query = $this->pdo->prepare($this->baseQuery);
    
        $query->execute();
    
        $result = $query->fetchAll();
    
        $compatibleParts = [];
    
        foreach ($result as $row) {
            $compatibleParts[] = $this->rowToObject($row);
        }
    
        return $compatibleParts;
    }

    abstract protected function getCompatibilityQuery(build $build) : null|array;
}