<?php

namespace App\Services\CerfaPrinter;

use App\Services\Cerfa\Cerfa;
use setasign\Fpdi\Fpdi;

trait CerfaPrinter
{
    private Cerfa $cerfa;
    private Fpdi $fpdi;

    public function __construct(Cerfa $cerfa, Fpdi $fpdi)
    {
        $this->cerfa = $cerfa;
        $this->fpdi = $fpdi;
    }

    public function hasPrinterMethod(string $methodName) : bool
    {
        return method_exists($this, $methodName);
    }
}
