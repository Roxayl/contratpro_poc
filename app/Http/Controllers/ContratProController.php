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

    public function create(Request $request)
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

    private function generateData()
    {
        return [
            'employeur' => [
                'denomination' => "WAM Dentaire",
            ],
            'salarie' => [
                //
            ]
        ];
    }
}
