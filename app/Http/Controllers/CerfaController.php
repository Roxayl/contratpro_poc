<?php

namespace App\Http\Controllers;

use App\Services\Cerfa\Cerfa;
use App\Services\Cerfa\CerfaConfig;
use Illuminate\Http\Request;

class CerfaController extends Controller
{
    public function poc(Request $request)
    {
        $cerfaConfig = new CerfaConfig();
        $cerfaConfig->loadFromFile(base_path('resources/cerfa/cerfa.json'));

        $cerfa = new Cerfa($cerfaConfig);
        dd($cerfa);

        $cerfa->hydrateData($request->all());

        return $cerfa->generatePdf();
    }
}
