<?php

namespace App\Models;

class Tuteur extends OfflineModel
{
    public ?string $nom = null;
    public ?string $prenom = null;
    public ?string $emploi = null;
    public ?string $dateNaissance = null;
    public ?string $utilNom = null;
    public ?string $utilPrenom = null;
    public ?string $utilEmploi = null;
    public ?string $utilDateNaissance = null;
}
