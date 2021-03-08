<?php

namespace App\Services\Cerfa;

use InvalidArgumentException;

abstract class Field
{
    private Cerfa $cerfa;

    private ?string $name;
    private ?string $type;
    private ?string $label;
    private ?string $description = null;
    private ?float $x;
    private ?float $y;

    public function __construct(string $name, \stdClass $config, Cerfa $cerfa)
    {
        $this->cerfa = $cerfa;

        $this->name = $name;
        $this->type = $config->type;
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

    public function getName() : ?string
    {
        return $this->name;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getArray() : array
    {
        return get_object_vars($this);
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
