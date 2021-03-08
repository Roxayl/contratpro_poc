<?php

namespace App\Http\Controllers;

use App\Services\Cerfa\Cerfa;
use App\Services\Cerfa\CerfaConfig;
use App\Services\Cerfa\CerfaPdfGenerator;
use App\Services\Printers\CerfaPrinter12434_03;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class CerfaController extends Controller
{
    public function form(Request $request)
    {
        $cerfaConfig = new CerfaConfig();
        $cerfaConfig->loadFromFile(base_path('resources/cerfa/cerfa.json'));

        $cerfa = new Cerfa($cerfaConfig);
        return view('cerfa.form')->with('content', $cerfa->generateForm());
    }

    public function generate()
    {
        $data = $this->getData();

        $cerfaConfig = new CerfaConfig();
        $cerfaConfig->loadFromFile(base_path('resources/cerfa/cerfa.json'));

        $cerfa = new Cerfa($cerfaConfig);
        $cerfa->hydrateData($data);

        $pdfPath = public_path('pdf/cerfa' . $cerfaConfig->getConfig()->cerfa . '.pdf');
        $printer = new CerfaPrinter12434_03($cerfa);
        $pdfGenerator = new CerfaPdfGenerator($cerfa, $printer, $pdfPath);

        $cerfa->generatePdf($pdfGenerator);
    }

    private function getData()
    {
        return [
            'employeurDenomination' => 'WAM',
            'employeurNoAdresse' => '23',
            'employeurVoieAdresse' => "Rue Fesch",
            'employeurTelephone' => "0495208678"
        ];
    }
}
