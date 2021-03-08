<?php

namespace App\Services\CerfaPrinter;

interface Printable
{
    public function hasPrinterMethod(string $methodName);
}
