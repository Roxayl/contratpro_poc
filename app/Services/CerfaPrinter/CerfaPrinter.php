<?php

namespace App\Services\CerfaPrinter;

use App\Services\Cerfa\Cerfa;
use App\Services\Cerfa\Field;
use setasign\Fpdi\Fpdi;

class   CerfaPrinter implements Printable
{
    use CerfaPrinterTrait;

    protected Cerfa $cerfa;
    protected Fpdi $fpdi;

    public function __construct(Cerfa $cerfa)
    {
        $this->cerfa = $cerfa;
        $this->fpdi = new Fpdi();
    }

    public function print(Field $field) : void
    {
        if($field->getType() == 'text') {
            $this->printText($field);
        }
    }

    private function printText(Field $field) : void
    {
        $text = 'TEST';
        $spacing = $field->spacing;
        $x = $field->getX();
        $y = $field->getY();

        $arr = str_split(strtoupper($text));
        $this->pdf->setXY($x, $y);
        foreach($arr as $key => $char) {
            $this->fpdi->cell(3, 5, $char);
            $x += $spacing;
            $this->fpdi->setX($x);
        }
    }

    public function getFpdi(): Fpdi
    {
        return $this->fpdi;
    }
}
