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
        $data = $this->generateData();

        $employeur = new Employeur();
        $employeur->mapFromArray($data['employeur']);

        $salarie = new Salarie();
        $salarie->mapFromArray($data['salarie']);

        $contratPro = new ContratPro($employeur, $salarie);

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
