<?php

namespace App\Services\CerfaPrinter;

trait CerfaPrinterTrait
{
    public function hasPrinterMethod(string $methodName): bool
    {
        return method_exists($this, $methodName);
    }
}
