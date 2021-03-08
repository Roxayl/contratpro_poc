<?php

namespace App\Services\Cerfa;

class Text extends Field
{
    public ?float $spacing;

    public function __construct(\stdClass $config)
    {
        parent::__construct($config);
        $this->spacing = $config->spacing;
    }
}
