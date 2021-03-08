<?php

namespace App\Services\CerfaPrinter;

use App\Services\Cerfa\Cerfa;
use App\Services\Cerfa\CerfaPdfGenerator;
use App\Services\Cerfa\Field;
use setasign\Fpdi\Fpdi;

class CerfaPrinter implements Printable
{
    use CerfaPrinterTrait;

    protected Cerfa $cerfa;
    protected ?CerfaPdfGenerator $pdfGenerator = null;

    public function __construct(Cerfa $cerfa)
    {
        $this->cerfa = $cerfa;
    }

    public function setGenerator(CerfaPdfGenerator $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    public function print(Field $field) : void
    {
        if($field->getType() == 'text') {
            $this->printText($field);
        }
    }

    private function printText(Field $field) : void
    {
        $fpdi = $this->getFpdi();

        $text = $field->getValue();
        $spacing = $field->spacing;
        $x = $field->getX();
        $y = $field->getY();

        $arr = str_split(strtoupper($text));
        $fpdi->setXY($x, $y);
        foreach($arr as $key => $char) {
            $fpdi->cell(3, 5, $char);
            $x += $spacing;
            $fpdi->setX($x);
        }
    }

    public function getFpdi(): Fpdi
    {
        return $this->cerfa->getPdfGenerator()->getFpdi();;
    }
}
