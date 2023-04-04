<?php

namespace App\Build;
use App\Parent\PdoDb;

class BuildPdo extends PdoDb
{
    private const TABLE_NAME = 'builds';
    private const UPDATE_QUERY = 'UPDATE builds SET user_id = :user_id, name = :name, parts = :parts WHERE id = :id';
    private const INSERT_QUERY = 'INSERT INTO builds (user_id, name, parts) VALUES (:user_id, :name, :parts)';

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::UPDATE_QUERY, self::INSERT_QUERY);
    }


    public function rowToObject(array|bool $row): Build|bool
    {
        if (!$row){
            return $row;
        } else 
        return new Build(
            $row['user_id'],
            $row['name'],
            json_decode($row['parts'],true),
            $row['id']
        );
        
    }

    public function objectToRow($item): array
    {
        return [
            'user_id' => $item->getUserId(),
            'name' => $item->getName(),
            'parts' => json_encode($item->getParts()),
            'id' => $item->getId()
        ];
    }

}
