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
        return response()->json($model->generateData());
    }

    public function generateManyJson(Request $request)
    {
        $occurrences = $request->input('occurrences') ?? 5;
        $result = [];

        for($i = 0; $i < $occurrences; $i++) {
            $model = new Cerfa12434_03();
            $result[] = $model->generateData();
        }

        return response()->json($result);
    }
}
