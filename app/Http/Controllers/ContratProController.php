<?php

namespace App\Http\Controllers;

use App\Models\ContratPro;
use App\Models\Employeur;
use App\Models\Salarie;
use App\Models\Tuteur;
use App\Services\Pdf\RemplirContratPro;
use Illuminate\Http\Request;

class ContratProController extends Controller
{
    public function fill()
    {
        return view('contrat.form');
    }

    public function createFromDummyData()
    {
        // Données d'entrée, autogénérées
        $data = $this->generateData();

        // Créer les modèles
        $employeur = new Employeur();
        $employeur->mapFromArray($data['employeur']);
        $salarie = new Salarie();
        $salarie->mapFromArray($data['salarie']);
        $tuteur = new Tuteur();
        $tuteur->mapFromArray($data['tuteur']);

        // Les assembler dans ContratPro
        $contratPro = new ContratPro($employeur, $salarie, $tuteur);

        // Générer le pdf
        $pdfService = new RemplirContratPro($contratPro);
        $pdfService->fill();
        $pdfService->output();
    }

    public function createFromRequest(Request $request)
    {
        // Créer les modèles, avec les données provenant de la requête.
        $employeur = new Employeur();
        $employeur->mapFromArray($request->get('employeur'));
        $salarie = new Salarie();
        $salarie->mapFromArray($request->get('salarie'));
        $tuteur = new Tuteur();
        $tuteur->mapFromArray($request->get('tuteur'));

        // Les assembler dans ContratPro
        $contratPro = new ContratPro($employeur, $salarie, $tuteur);

        // Générer le pdf
        $pdfService = new RemplirContratPro($contratPro);
        $pdfService->fill();
        $pdfService->output();
    }

    private function generateData()
    {
        return [
            'employeur' => [
                'denomination' => "WAM Dentaire",
                'noAdresse' => "23",
                'voieAdresse' => "Rue Fesch",
                'complementAdresse' => "Test bidule",
                'codePostal' => '13100',
                'commune' => "Aix-en-Provence",
                'telephone' => "0680906158",
                'courriel' => "dev@wamkey.com",
                'caisseRetraiteComplementaire' => "Retraite",
                'orgPrevoyance' => "AGIRC",
                'particulierEmployeur' => true,
                'urssafParticulierEmployeur' => 'test',
                'siret' => "36252187900034",
                'naf' => "43273",
                'effectif' => "33",
                'conventionCollective' => "commerces de détail non alimentaires",
                'idcc' => "4329",
            ],
            'salarie' => [
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
                'salarieRqth' => true,
                'salarieInscritPoleEmploi' => true,
                'salarieNoPoleEmploi' => '45134512',
                'salarieDureePoleEmploi' => '5',
                'salarieSituationAvantContrat' => 'NA',
                'salarieTypeMinimumSocial' => 'Q',
                'salarieDiplomePlusEleveObtenu' => 'AA',
            ],
            'tuteur' => [
                'tuteurNom' => "Monique",
                'tuteurPrenom' => "Rolbert",
                'tuteurEmploi' => "Maître de conférences",
                'tuteurDateNaissance' => "19/06/1986",
                'tuteurUtilNom' => "Dupont",
                'tuteurUtilPrenom' => "Jean",
                'tuteurUtilEmploi' => "Président",
                'tuteurUtilDateNaissance' => "03/12/1977"
            ]
        ];
    }
}
