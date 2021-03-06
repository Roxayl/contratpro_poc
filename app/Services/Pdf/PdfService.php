<?php

namespace App\Services\Pdf;

use setasign\Fpdi\Fpdi;

abstract class PdfService
{
    protected Fpdi $pdf;
    protected string $file = 'pdf/cerfa_13751.pdf';
    protected $model;

    public function output()
    {
        $this->pdf->Output();
    }
}
