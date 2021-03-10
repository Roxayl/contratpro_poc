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
        $streetName = function () {
            return explode(' ', $this->faker->streetName(), 2)[1];
        };

        $voieAdresse = function () {
            return $this->faker->randomElement(['Rue', 'Avenue', 'Boulevard', 'Chemin']);
        };

        $postCode = function () {
            return str_replace(' ', '', $this->faker->postcode());
        };

        $nirSalarie = function () {
            return $this->faker->optional(0.5)->passthrough(
                $this->faker->numberBetween(1, 2)
                . $this->faker->numberBetween(56, 97)
                . $this->faker->numerify('##########'));
        };

        $this->data = [
            'employeurDenomination' => $this->faker->company(),
            'employeurNoAdresse' => $this->faker->buildingNumber(),
            'employeurVoieAdresse' => $voieAdresse(),
            'employeurComplementAdresse' => $streetName(),
            'employeurCodePostal' => $postCode(),
            'employeurCommune' => $this->faker->city(),
            'employeurTelephone' => '04' . $this->faker->numerify('########'),
            'employeurCourriel' => $this->faker->email(),
            'employeurCaisseRetraiteComplementaire' => $this->faker->randomElement(['Agirc', 'Arrco']),
            'employeurOrgPrevoyance' => 'Test',
            'employeurParticulierEmployeur' => 'non',
            'employeurUrssafParticulierEmployeur' => 'test',
            'employeurSiret' => $this->faker->numerify('##############'),
            'employeurNaf' => $this->faker->numerify('#####'),
            'employeurEffectif' => $this->faker->numberBetween(7, 539),
            'employeurConventionCollective' => $this->faker->randomElement(
                ["commerces de détail non alimentaires", "glaces, sorbets, crèmes glacées"]),
            'employeurIdcc' => $this->faker->numerify('####'),

            'salarieNom' => $this->faker->lastName(),
            'salariePrenom' => $this->faker->firstName(),
            'salarieNoAdresse' => $this->faker->buildingNumber(),
            "salarieVoieAdresse" => $voieAdresse(),
            "salarieComplementAdresse" => $streetName(),
            "salarieCodePostal" => $postCode(),
            "salarieCommune" => $this->faker->city(),
            'salarieTelephone' => '06' . $this->faker->numerify('########'),
            'salarieCourriel' => $this->faker->email(),
            'salarieNirSalarie' => $nirSalarie(),
            'salarieDateNaissance' => '03/02/1996',
            'salarieSexe' => $this->faker->randomElement(['M', 'F']),
            'salarieRqth' => $this->faker->randomElement(['oui', 'non']),
            'salarieInscritPoleEmploi' => 'oui',
            'salarieNoPoleEmploi' => $this->faker->numerify('########'),
            'salarieDureePoleEmploi' => $this->faker->numberBetween(1, 6),
            'salarieSituationAvantContrat' => $this->faker->numberBetween(1, 10),
            'salarieTypeMinimumSocial' => $this->faker->numberBetween(0, 3),
            'salarieDiplomePlusEleveObtenu' => $this->faker->randomElement(['12', '19', '49', '60']),

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
