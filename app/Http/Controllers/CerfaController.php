<?php

namespace App\Http\Controllers;

use App\Models\Cerfa12434_03;
use App\Services\Cerfa\Cerfa;
use App\Services\Cerfa\CerfaConfig;
use App\Services\Cerfa\CerfaPdfGenerator;
use App\Services\Printers\CerfaPrinter12434_03;
use Illuminate\Http\Request;

class CerfaController extends Controller
{
    public function form(Request $request)
    {
        $cerfaConfig = new CerfaConfig();
        $cerfaConfig->loadFromFile(base_path('resources/cerfa/cerfa.json'));

        $cerfa = new Cerfa($cerfaConfig);
        return view('cerfa.form')->with('content', $cerfa->generateForm());
    }

    public function generate(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
        } else {
            $model = new Cerfa12434_03();
            $data = $model->generateData();
        }

        // On charge les données de configuration depuis le json !
        $cerfaConfig = new CerfaConfig();
        $cerfaConfig->loadFromFile(base_path('resources/cerfa/cerfa.json'));

        // Créer un objet Cerfa
        $cerfa = new Cerfa($cerfaConfig);

        // Ajouter les données...
        $cerfa->hydrateData($data);

        // Génération du PDF !
        // Emplacement du fichier pdf
        $pdfPath = public_path('pdf/cerfa_' . $cerfaConfig->getConfig()->cerfa . '.pdf');
        // Printer contient les méthodes spécifiques au formulaire Cerfa pour gérer certains champs.
        $printer = new CerfaPrinter12434_03($cerfa);
        // PdfGenerator correspond à la classe permettant de gérer l'impression d'un PDF. Elle utilise un
        // printer pour gérer l'impression de certains champs qui nécessitent une logique plus compliquée.
        $pdfGenerator = new CerfaPdfGenerator($cerfa, $pdfPath, $printer);

        // On définit le générateur de PDF...
        $cerfa->setGenerator($pdfGenerator);

        // Impression !
        $cerfa->generatePdf();
    }
}
