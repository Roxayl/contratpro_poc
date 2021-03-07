<?php

namespace App\Http\Controllers;

use App\Models\ContratPro;
use App\Models\Employeur;
use App\Models\Salarie;
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

        // Les assembler dans ContratPro
        $contratPro = new ContratPro($employeur, $salarie);

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
        // $salarie->mapFromArray($request->get('salarie'));

        // Les assembler dans ContratPro
        $contratPro = new ContratPro($employeur, $salarie);

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
                'conventionCollective' => "INGENIEURS INFORMATICIENS",
                'idcc' => "4329",
            ],
            'salarie' => [
                'nom' => "Nicolas",
                'prenom' => "Quentin",
                'noAdresse' => "45",
                "voieAdresse" => "Rue des Peupliers",
                "complementAdresse" => "N/A",
                "codePostal" => '13010',
                "commune" => 'Marseille',
                'telephone' => "068906158",
                'courriel' => 'qnicolas@gmail.com',
                'nirSalarie' => '136469',
                'dateNaissance' => '03/02/1996',
                'sexe' => 'M',
                'rqth' => true,
                'inscritPoleEmploi' => true,
                'noPoleEmploi' => '45134512',
                'dureePoleEmploi' => '5',
                'situationAvantContrat' => 'NA',
                'typeMinimumSocial' => 'Q',
                'diplomePlusEleveObtenu' => 'AA',
            ]
        ];
    }
}
