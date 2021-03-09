<?php

namespace App\Http\Controllers;

use App\Models\Cerfa12434_03;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function generateCsv(Request $request)
    {
        //
    }

    public function generateJson(Request $request)
    {
        $model = new Cerfa12434_03();
        return response($model->generateData());
    }
}
