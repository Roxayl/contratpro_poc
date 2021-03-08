<?php

namespace App\Services\Cerfa;

class Page
{
    private ?int $noPage;
    private ?array $fields;

    public function __construct(int $noPage)
    {
        $this->noPage = $noPage;
        $this->fields = [];
    }

    public function addField(Field $field) : void
    {
        $this->fields[$field->getName()] = $field;
    }

    /**
     * @return Field[]|array
     */
    public function getFields() : ?array
    {
        return $this->fields;
    }
}
