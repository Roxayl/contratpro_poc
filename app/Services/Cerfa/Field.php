<?php

namespace App\Services\Cerfa;

class Field
{
    private ?string $name;
    private ?string $label;
    private ?string $description;
    private ?string $x;
    private ?string $y;

    public function __construct(\stdClass $config)
    {
        $this->name = $config->name;
        $this->label = $config->label;
        $this->description = $config->description;
        $this->x = $config->x;
        $this->y = $config->y;
    }
}
