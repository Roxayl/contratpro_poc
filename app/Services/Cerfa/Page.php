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

    public function addField(Field $field)
    {
        $this->fields[$field->getName()] = $field;
    }
}
