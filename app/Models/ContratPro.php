<?php

namespace App\Models;

class ContratPro
{
    public ?Employeur $employeur;
    public ?Salarie $salarie;

    public function __construct(Employeur $employeur, Salarie $salarie)
    {
        $this->employeur = $employeur;
        $this->salarie = $salarie;
    }
}
