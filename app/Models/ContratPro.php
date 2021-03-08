<?php

namespace App\Models;

class ContratPro
{
    public ?Employeur $employeur;
    public ?Salarie $salarie;
    public ?Tuteur $tuteur;

    public function __construct(Employeur $employeur, Salarie $salarie, Tuteur $tuteur)
    {
        $this->employeur = $employeur;
        $this->salarie = $salarie;
        $this->tuteur = $tuteur;
    }
}
