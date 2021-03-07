<?php

namespace App\Services\Cerfa;

class Field
{
    private ?string $name = null;
    private ?string $label = null;
    private ?string $description = null;
    private ?string $x = null;
    private ?string $y = null;

    public function __construct(\stdClass $config)
    {
        $this->name = $config->name;
        $this->label = $config->label;
        $this->description = $config->description;
        $this->x = $config->x;
        $this->y = $config->y;
    }
}
