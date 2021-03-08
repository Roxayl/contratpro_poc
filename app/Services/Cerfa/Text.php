<?php

namespace App\Services\Cerfa;

class Text extends Field
{
    public ?float $spacing;

    public function __construct(string $name, \stdClass $config)
    {
        parent::__construct($name, $config);

        $this->spacing = $config->spacing;
    }
}
