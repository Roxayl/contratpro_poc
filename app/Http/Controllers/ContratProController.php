<?php

namespace App\Http\Controllers;

use App\Models\ContratPro;
use App\Models\Employeur;
use App\Models\Salarie;
use App\Services\Pdf\RemplirContratPro;
use Illuminate\Http\Request;
use App\Services\Pdf\RemplirDeclarationAchat;

class ContratProController extends Controller
{
    public function fill()
    {
        return view('contrat.form');
    }

    public function create(Request $request)
    {
        $data = $this->generateData();

        $employeur = new Employeur();
        $employeur->mapFromArray($data['employeur']);

        $salarie = new Salarie();
        $salarie->mapFromArray($data['salarie']);

        $contratPro = new ContratPro($employeur, $salarie);

        $pdfService = new RemplirContratPro($contratPro);
    }

    private function generateData()
    {
        return [
            'employeur' => [
                'nomPrenom' => "WAM Dentaire",
            ]
        ];
    }
}
