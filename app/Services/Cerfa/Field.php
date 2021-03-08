<?php

namespace App\Services\Cerfa;

use InvalidArgumentException;

abstract class Field
{
    private Cerfa $cerfa;

    private ?string $name;
    private ?string $label;
    private ?string $description = null;
    private ?string $x;
    private ?string $y;

    public function __construct(string $name, \stdClass $config, Cerfa $cerfa)
    {
        $this->cerfa = $cerfa;

        $this->name = $name;
        $this->label = $config->label;
        if(!empty($config->description))
            $this->description = $config->description;
        $this->x = $config->x;
        $this->y = $config->y;
    }

    static function create(string $name, \stdClass $config, Cerfa $cerfa) : Field
    {
        $type = $config->type;

        switch($type) {
            case 'text':
                $class = Text::class; break;
            default:
                throw new InvalidArgumentException("Classe non existante.");
        }

        return new $class($name, $config, $cerfa);
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
