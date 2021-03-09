<?php

namespace App\Http\Controllers;

use App\Models\Cerfa12434_03;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use LogicException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    private string $cerfaModel;

    public function __construct()
    {
        $this->cerfaModel = Cerfa12434_03::class;
    }

    public function generateCsv(): StreamedResponse
    {
        return $this->exportToCsv('cerfa12434_03', [$this->getOneData()]);
    }

    public function generateJson(Request $request): JsonResponse
    {
        return response()->json($this->getOneData());
    }

    public function generateManyJson(string $occurrences = "5"): JsonResponse
    {
        $result = [];

        for($i = 0; $i < (int)$occurrences; $i++) {
            $result[] = $this->getOneData();
        }

        return response()->json($result);
    }

    public function generateManyCsv(string $occurrences = "5"): StreamedResponse
    {
        $result = [];

        for($i = 0; $i < (int)$occurrences; $i++) {
            $result[] = $this->getOneData();
        }

        return $this->exportToCsv('cerfa12434_03', $result);
    }

    private function getOneData(): array
    {
        $model = new $this->cerfaModel();
        return $model->generateData();
    }

    private function exportToCsv($filename, $data): StreamedResponse
    {
        $filename = $filename . '-' . Carbon::today()->format('Y-m-d') . '.csv';

        // Headers de la réponse
        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=' . $filename
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];

        // Ajouter les en-têtes en haut du tableau
        array_unshift($data, array_keys($data[array_key_first($data)]));

        // Créer un flux qui sera rempli petit à petit de lignes formatées CSV...
        $callback = function() use ($data) {
            $FH = fopen('php://output', 'w');
            foreach ($data as $row) {
                $status = fputcsv($FH, $row);
                if($status === false)
                    throw new LogicException("fputcsv() error");
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers);
    }
}
