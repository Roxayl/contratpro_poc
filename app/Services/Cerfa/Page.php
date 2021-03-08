<?php

namespace App\Services\Cerfa;

use Exception;

class Page
{
    private ?int $noPage;
    private ?array $fields;

    public function __construct(int $noPage)
    {
        $this->noPage = $noPage;
        $this->fields = [];
    }

    public function addField(Field $field): void
    {
        $this->fields[$field->getName()] = $field;
    }

    /**
     * @return Field[]|array
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    public function hasField(string $fieldName): bool
    {
        return isset($this->fields[$fieldName]);
    }

    public function getField(string $fieldName): Field
    {
        if(! $this->hasField($fieldName)) {
            throw new Exception();
        }
        return $this->fields[$fieldName];
    }
}
