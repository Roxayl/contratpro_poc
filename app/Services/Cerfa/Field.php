<?php

namespace App\Services\Cerfa;

use InvalidArgumentException;
use stdClass;

abstract class Field
{
    private Cerfa $cerfa;

    private ?string $name;
    private ?string $type;
    private ?string $label;
    private ?string $description = null;

    private ?string $value;

    public function __construct(string $name, stdClass $config, Cerfa $cerfa)
    {
        $this->cerfa = $cerfa;

        $this->name = $name;
        $this->type = $config->type;
        $this->label = $config->label;
        if(! empty($config->description))
            $this->description = $config->description;
        $this->value = null;
    }

    static function create(string $name, stdClass $config, Cerfa $cerfa): Field
    {
        $type = $config->type;

        switch($type) {
            case 'text':
                $class = Text::class; break;
            case 'radio':
                $class = Radio::class; break;
            default:
                throw new InvalidArgumentException("Classe non existante.");
        }

        return new $class($name, $config, $cerfa);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getArray(): array
    {
        return get_object_vars($this);
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }
}
