<?php

namespace App\Models;

class Salarie extends OfflineModel
{
    public string $nom;
    public string $prenom;
    public string $noAdresse;
    public string $voieAdresse;
    public string $complementAdresse;
    public string $commune;
    public string $telephone;
    public string $courriel;
    public string $nirSalarie;
    public string $dateNaissance;
    public string $sexe;
    public bool $rqth;
    public bool $inscritPoleEmploi;
    public string $noInscription;
    public int $dureePoleEmploi;
    public string $situationAvantContrat;
    public string $typeMinimumSocial;
    public string $diplomePlusEleveObtenu;
}
