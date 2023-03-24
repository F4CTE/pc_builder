<?php
namespace App;

abstract class DataImport {
    private string $path;

    public function __construct(string $path) {
        $this->path = $path;
    }

    public function import()  {
        $filecontents = file_get_contents($this->path);
        $elements = json_decode($filecontents, true);
        foreach ($elements as $element) {
            $dbItem = $this->createDbItem($element);
        }
    }

    abstract public function createDbItem(array $arrayItem) : DbItem ;


}