<?php

namespace App\Models;

class Employeur extends OfflineModel
{
    public string $denomination;
    public string $noAdresse;
    public string $voieAdresse;
    public string $complementAdresse;
    public string $commune;
    public string $telephone;
    public string $courriel;
    public string $caisseRetraiteComplementaire;
    public string $orgPrevoyance;
    public bool $particulierEmployeur;
    public string $urssafParticulierEmployeur;
    public string $siret;
    public string $naf;
    public string $conventionCollective;
    public string $idccConvention;
}
