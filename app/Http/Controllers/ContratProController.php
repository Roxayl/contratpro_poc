<?php

namespace App\Http\Controllers;

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

    }
}
