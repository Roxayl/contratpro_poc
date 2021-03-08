<?php

namespace App\Services\Cerfa;

class Text extends Field
{
    public ?float $spacing;

    public function __construct(string $name, \stdClass $config, Cerfa $cerfa)
    {
        parent::__construct($name, $config, $cerfa);

        if($cerfa->hasGlobal('defaultSpacing')) {
            $spacing = $cerfa->getGlobal('defaultSpacing');
        } else {
            $spacing = $config->spacing;
        }
        $this->spacing = $spacing;
    }
}
