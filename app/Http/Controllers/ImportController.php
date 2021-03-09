<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        var_dump($this->parseCsv($array));
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
