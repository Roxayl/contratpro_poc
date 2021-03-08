<?php

namespace App\Services\Cerfa;

class Text extends Field
{
    private ?float $spacing;
    private ?float $x;
    private ?float $y;

    public function __construct(string $name, \stdClass $config, Cerfa $cerfa)
    {
        parent::__construct($name, $config, $cerfa);

        if($cerfa->hasGlobal('defaultSpacing')) {
            $spacing = $cerfa->getGlobal('defaultSpacing');
        } else {
            $spacing = $config->spacing;
        }

        $this->x = $config->x;
        $this->y = $config->y;
        $this->spacing = $spacing;
    }

    public function getSpacing(): float
    {
        return $this->spacing;
    }

    public function getX(): ?float
    {
        return $this->x;
    }

    public function getY(): ?float
    {
        return $this->y;
    }
}
