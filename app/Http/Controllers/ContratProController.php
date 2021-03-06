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
                'idccConvention' => "432873909",
            ],
            'salarie' => [
                //
            ]
        ];
    }
}
