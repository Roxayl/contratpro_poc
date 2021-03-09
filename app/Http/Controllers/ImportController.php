<?php

namespace App\Http\Controllers;

use App\Services\Cerfa\Cerfa;
use App\Services\Cerfa\CerfaConfig;
use App\Services\Cerfa\CerfaPdfGenerator;
use App\Services\Printers\CerfaPrinter12434_03;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ZipArchive;

class ImportController extends Controller
{
    public function form()
    {
        return view('cerfa.import-form');
    }

    public function import(Request $request)
    {
        $file = $request->file('importedFile')->get();

        // Génère un tableau, avec une case pour chaque ligne du fichier CSV.
        $array = explode("\n", $file);

        // On parse le CSV
        $cerfaDataList = $this->parseCsv($array);

        // On charge les données de configuration depuis le json !
        $cerfaConfig = new CerfaConfig();
        $cerfaConfig->loadFromFile(base_path('resources/cerfa/cerfa.json'));

        // Emplacement du fichier pdf initial
        $pdfPath = public_path('pdf/cerfa_' . $cerfaConfig->getConfig()->cerfa . '.pdf');

        // Pour chaque donnée Cerfa...
        foreach($cerfaDataList as $thisData) {
            // Créer un objet Cerfa
            $cerfa = new Cerfa($cerfaConfig);

            // Ajouter les données...
            $cerfa->hydrateData($thisData);

            // Génération du PDF !
            // Printer contient les méthodes spécifiques au formulaire Cerfa pour gérer certains champs.
            $printer = new CerfaPrinter12434_03($cerfa);
            // PdfGenerator correspond à la classe permettant de gérer l'impression d'un PDF. Elle utilise un
            // printer pour gérer l'impression de certains champs qui nécessitent une logique plus compliquée.
            $pdfGenerator = new CerfaPdfGenerator($cerfa, $pdfPath, $printer);

            // On définit le générateur de PDF...
            $cerfa->setGenerator($pdfGenerator);

            $randStr = Carbon::now()->format('Y-m-d') . '_' . Str::random(6);
            $fileName = 'cerfa_' . $cerfaConfig->getConfig()->cerfa . '_' . $randStr . '.pdf';
            $storagePath = storage_path('app/cerfa/generated/' . $fileName);

            // Impression ! ... et stockage dans un fichier
            $cerfa->generatePdf($storagePath, 'F');
        }
    }

    private function parseCsv(array $lines)
    {
        // Enlever les éléments du tableau vides.
        $array = array_filter($lines);

        // On importe le fichier csv avec str_getcsv()
        $csv = array_map('str_getcsv', $array);

        // Supprimer la première ligne, qui contient la liste des champs
        $columns = $csv[0];
        unset($csv[0]);

        // On recréé un tableau $result contenant un ensemble de champs
        // utilisable pour la génération d'un formulaire Cerfa...
        $cpt = 0;
        $result = [];
        foreach($csv as $key1 => $thisCerfa) {
            foreach($thisCerfa as $key2 => $value) {
                $result[$cpt][$columns[$key2]] = $value;
            }
            $cpt++;
        }

        return $result;
    }
}
