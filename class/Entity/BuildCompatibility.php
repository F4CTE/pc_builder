<?php 
namespace App\Compatibility;

use App\Build\build;

class BuildCompatibility {

    private ?build $build = null;

    public function __construct(build $build) {
        $this->build = new Build();
    }

    
}