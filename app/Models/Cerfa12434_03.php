<?php

namespace App\Models;

use Exception;
use Faker\Factory;
use Faker\Generator;

class Cerfa12434_03
{
    private Generator $faker;
    private array $data = [];

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function generateData(): array
    {
        $this->data = [
            'employeurDenomination' => $this->faker->company(),
            'employeurNoAdresse' => $this->faker->buildingNumber(),
            'employeurVoieAdresse' => "Rue",
            'employeurComplementAdresse' => $this->faker->streetName(),
            'employeurCodePostal' => $this->faker->postcode(),
            'employeurCommune' => $this->faker->city(),
            'employeurTelephone' => '04' . $this->faker->numerify('########'),
            'employeurCourriel' => $this->faker->email(),
            'employeurCaisseRetraiteComplementaire' => $this->faker->randomElement(['Agirc', 'Arrco']),
            'employeurOrgPrevoyance' => 'Test',
            'employeurParticulierEmployeur' => 'non',
            'employeurUrssafParticulierEmployeur' => 'test',
            'employeurSiret' => "36252187900034",
            'employeurNaf' => "43273",
            'employeurEffectif' => $this->faker->numberBetween(7, 539),
            'employeurConventionCollective' => "commerces de détail non alimentaires",
            'employeurIdcc' => "4329",

            'salarieNom' => $this->faker->lastName(),
            'salariePrenom' => $this->faker->firstName(),
            'salarieNoAdresse' => $this->faker->buildingNumber(),
            "salarieVoieAdresse" => $this->faker->streetName(),
            "salarieComplementAdresse" => $this->faker->optional(0.8)->streetName(),
            "salarieCodePostal" => $this->faker->postcode(),
            "salarieCommune" => $this->faker->city(),
            'salarieTelephone' => '06' . $this->faker->numerify('########'),
            'salarieCourriel' => $this->faker->email(),
            'salarieNirSalarie' => '136469',
            'salarieDateNaissance' => '03/02/1996',
            'salarieSexe' => $this->faker->randomElement(['M', 'F']),
            'salarieRqth' => $this->faker->randomElement(['oui', 'non']),
            'salarieInscritPoleEmploi' => 'oui',
            'salarieNoPoleEmploi' => $this->faker->buildingNumber(),
            'salarieDureePoleEmploi' => '5',
            'salarieSituationAvantContrat' => '2',
            'salarieTypeMinimumSocial' => $this->faker->numberBetween(0, 3),
            'salarieDiplomePlusEleveObtenu' => '12',

            'tuteurNom' => $this->faker->lastName(),
            'tuteurPrenom' => $this->faker->firstName(),
            'tuteurEmploi' => $this->faker->jobTitle(),
            'tuteurDateNaissance' => "19/06/1986",
            'tuteurUtilNom' => $this->faker->lastName(),
            'tuteurUtilPrenom' => $this->faker->firstName(),
            'tuteurUtilEmploi' => $this->faker->jobTitle(),
            'tuteurUtilDateNaissance' => "03/12/1977"
        ];

        return $this->data;
    }

    public function getFixedData(): array
    {
        $this->data = [
            'employeurDenomination' => 'WAM',
            'employeurNoAdresse' => '23',
            'employeurVoieAdresse' => "Rue",
            'employeurComplementAdresse' => "Major Montricher",
            'employeurCodePostal' => "20000",
            'employeurCommune' => "Ajaccio",
            'employeurTelephone' => "0495208678",
            'employeurCourriel' => 'romu_fabiani@yahoo.fr',
            'employeurCaisseRetraiteComplementaire' => 'Agirc',
            'employeurOrgPrevoyance' => 'Test',
            'employeurParticulierEmployeur' => 'non',
            'employeurUrssafParticulierEmployeur' => 'test',
            'employeurSiret' => "36252187900034",
            'employeurNaf' => "43273",
            'employeurEffectif' => "33",
            'employeurConventionCollective' => "commerces de détail non alimentaires",
            'employeurIdcc' => "4329",

            'salarieNom' => "Nicolas",
            'salariePrenom' => "Quentin",
            'salarieNoAdresse' => "45",
            "salarieVoieAdresse" => "Rue des Peupliers",
            "salarieComplementAdresse" => "N/A",
            "salarieCodePostal" => '13010',
            "salarieCommune" => 'Marseille',
            'salarieTelephone' => "068906158",
            'salarieCourriel' => 'qnicolas@gmail.com',
            'salarieNirSalarie' => '136469',
            'salarieDateNaissance' => '03/02/1996',
            'salarieSexe' => 'M',
            'salarieRqth' => 'oui',
            'salarieInscritPoleEmploi' => 'oui',
            'salarieNoPoleEmploi' => '45134512',
            'salarieDureePoleEmploi' => '5',
            'salarieSituationAvantContrat' => '3',
            'salarieTypeMinimumSocial' => '0',
            'salarieDiplomePlusEleveObtenu' => '43',

            'tuteurNom' => "Monique",
            'tuteurPrenom' => "Rolbert",
            'tuteurEmploi' => "Maître de conférences",
            'tuteurDateNaissance' => "19/06/1986",
            'tuteurUtilNom' => "Dupont",
            'tuteurUtilPrenom' => "Jean",
            'tuteurUtilEmploi' => "Président",
            'tuteurUtilDateNaissance' => "03/12/1977"
        ];

        return $this->data;
    }

    public function __get($key)
    {
        if(isset($this->data[$key])) {
            return $this->data[$key];
        }
        throw new Exception("Not found.");
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }
}
