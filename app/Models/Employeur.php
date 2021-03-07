<?php

namespace App\Models;

class Employeur extends OfflineModel
{
    public ?string $denomination = null;
    public ?string $noAdresse = null;
    public ?string $voieAdresse = null;
    public ?string $complementAdresse = null;
    public ?string $codePostal = null;
    public ?string $commune = null;
    public ?string $telephone = null;
    public ?string $courriel = null;
    public ?string $caisseRetraiteComplementaire = null;
    public ?string $orgPrevoyance = null;
    public ?bool $particulierEmployeur = null;
    public ?string $urssafParticulierEmployeur = null;
    public ?string $siret = null;
    public ?string $naf = null;
    public ?string $effectif = null;
    public ?string $conventionCollective = null;
    public ?string $idcc = null;
}
