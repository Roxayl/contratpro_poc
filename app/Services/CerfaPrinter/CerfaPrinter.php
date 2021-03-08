<?php

namespace App\Services\CerfaPrinter;

use App\Services\Cerfa\Cerfa;
use App\Services\Cerfa\Field;
use Illuminate\Support\Str;

trait CerfaPrinter
{
    public function __construct(Cerfa $cerfa)
    {
        $this->cerfa = $cerfa;
    }

    public function hasPrinterMethod(string $methodName) : bool
    {
        return method_exists($this, $methodName);
    }
}
