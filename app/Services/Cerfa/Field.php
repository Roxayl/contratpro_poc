<?php

namespace App\Services\Cerfa;

use InvalidArgumentException;

abstract class Field
{
    private ?string $name;
    private ?string $label;
    private ?string $description = null;
    private ?string $x;
    private ?string $y;

    public function __construct(string $name, \stdClass $config)
    {
        $this->name = $name;
        $this->label = $config->label;
        if(!empty($config->description))
            $this->description = $config->description;
        $this->x = $config->x;
        $this->y = $config->y;
    }

    static function create(string $name, \stdClass $config)
    {
        $type = $config->type;

        switch($type) {
            case 'text':
                $class = Text::class; break;
            default:
                throw new InvalidArgumentException("Classe non existante.");
        }

        return new $class($name, $config);
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
