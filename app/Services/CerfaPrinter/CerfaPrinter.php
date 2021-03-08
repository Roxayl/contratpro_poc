<?php

namespace App\Services\CerfaPrinter;

use App\Services\Cerfa\Cerfa;
use App\Services\Cerfa\CerfaPdfGenerator;
use App\Services\Cerfa\Field;
use App\Services\Cerfa\Radio;
use App\Services\Cerfa\Text;
use Exception;
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

    public function setGenerator(CerfaPdfGenerator $pdfGenerator): void
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    public function print(Field $field): void
    {
        $class = get_class($field);
        if($class === Text::class)
            $this->printText($field);
        if($class === Radio::class)
            $this->printRadio($field);
    }

    protected function printText(Text $field): void
    {
        $fpdi = $this->getFpdi();

        $text = $field->getValue();
        $spacing = $field->getSpacing();
        $x = $field->getX();
        $y = $field->getY();

        $this->writeWithSpacing($text, $x, $y, $spacing);
    }

    protected function writeWithSpacing(?string $str, float $x, float $y, float $spacing): void
    {
        $arr = str_split(strtoupper(utf8_decode($str)));
        $this->getFpdi()->setXY($x, $y);
        foreach($arr as $key => $char) {
            $this->getFpdi()->cell(3, 5, $char);
            $x += $spacing;
            $this->getFpdi()->setX($x);
        }
    }

    protected function printRadio(Radio $field) {
        $text = 'X';
        $value = $field->getValue();

        $selected = $field->getOptions()->$value;
        $x = $selected->x;
        $y = $selected->y;

        $this->writeWithSpacing($text, $x, $y, 0);
    }

    public function getFpdi(): Fpdi
    {
        return $this->cerfa->getPdfGenerator()->getFpdi();;
    }
}
