<?php

namespace App\Services\Printers;

use App\Services\Cerfa\Cerfa;
use App\Services\Cerfa\Field;
use App\Services\CerfaPrinter\CerfaPrinter;
use App\Services\CerfaPrinter\Printable;

class CerfaPrinter12434_03 implements Printable
{
    use CerfaPrinter;

    private Cerfa $cerfa;

    private function printEmployeurTelephone(Field $field) : void
    {
        $x = $field->getX();
        $y = $field->getY();
        $telephone = str_split($field->getName());
        // str_split() enlève le '0' initial du numéro...
        array_unshift($telephone, '0');
        foreach($telephone as $i => $chiffre) {
            $this->pdf->cell(3, 5, $chiffre);
            if($i % 2 == 0) $x += 5.3;
            else            $x += 4;
            $this->pdf->setXY($x, $y);
        }
    }
}
