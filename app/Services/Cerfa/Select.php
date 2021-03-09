<?php

namespace App\Services\Cerfa;

use stdClass;

class Select extends Text
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

    public function getPrint(): string
    {
        $value = $this->getValue();

        $print = $value;
        if($value !== null && property_exists($this->getOptions()->$value, 'print')) {
            $print = $this->getOptions()->$value->print;
        }
        return $print;
    }
}
