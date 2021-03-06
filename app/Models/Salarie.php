<?php

namespace App\Models;

class Salarie extends OfflineModel
{
    public ?string $nom = null;
    public ?string $prenom = null;
    public ?string $noAdresse = null;
    public ?string $voieAdresse = null;
    public ?string $complementAdresse = null;
    public ?string $commune = null;
    public ?string $telephone = null;
    public ?string $courriel = null;
    public ?string $nirSalarie = null;
    public ?string $dateNaissance = null;
    public ?string $sexe = null;
    public ?bool $rqth = null;
    public ?bool $inscritPoleEmploi = null;
    public ?string $noInscription = null;
    public ?int $dureePoleEmploi = null;
    public ?string $situationAvantContrat = null;
    public ?string $typeMinimumSocial = null;
    public ?string $diplomePlusEleveObtenu = null;
}
