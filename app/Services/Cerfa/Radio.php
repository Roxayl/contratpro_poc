<?php

namespace App\Services\Cerfa;

use stdClass;

class Radio extends Field
{
    public ?stdClass $options;

    public function __construct(string $name, stdClass $config, Cerfa $cerfa)
    {
        parent::__construct($name, $config, $cerfa);

        $this->options = $config->options;
    }

    public function getOptions(): ?stdClass
    {
        return $this->options;
    }
}
