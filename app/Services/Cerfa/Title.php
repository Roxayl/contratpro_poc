<?php

namespace App\Services\Cerfa;

use stdClass;

class Title extends Field
{
    public ?int $level;

    public function __construct(string $name, stdClass $config, Cerfa $cerfa)
    {
        parent::__construct($name, $config, $cerfa);

        $this->level = $config->level;
    }

    public function getLevel(): ?stdClass
    {
        return $this->level;
    }
}
