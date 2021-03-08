<?php

namespace App\Services\Printers;

use App\Services\Cerfa\Field;
use App\Services\CerfaPrinter\CerfaPrinter;
use App\Services\CerfaPrinter\CerfaPrinterTrait;

class CerfaPrinter12434_03 extends CerfaPrinter
{
    use CerfaPrinterTrait;

    public function printEmployeurTelephone(Field $field): void
    {
        $x = $field->getX();
        $y = $field->getY();
        $telephone = str_split($field->getValue());
        // str_split() enlève le '0' initial du numéro...
        array_unshift($telephone, '0');
        foreach($telephone as $i => $chiffre) {
            $this->getFpdi()->cell(3, 5, $chiffre);
            if($i % 2 == 0) $x += 5.3;
            else            $x += 4;
            $this->getFpdi()->setXY($x, $y);
        }
    }

    public function printEmployeurCourriel(Field $field) : void
    {
        $spacing = 3.45;
        $array = explode("@", $field->getValue());
        $user = $array[0];
        $domain = $array[1];
        $this->writeWithSpacing($user, 8.6, 113.6, $spacing);
        $this->writeWithSpacing($domain, 61, 113.6, $spacing);
    }

    public function printEmployeurConventionCollective(Field $field) : void
    {
        $maxWidth = 22;
        $words = explode(" ", utf8_decode($field->getValue()));
        $lineBreakSpacing = 6.7;
        $x = 106.3;
        $y = 117;
        $currentLine = 1;
        $lineWordCount = 0;
        $spacing = 4.13;
        foreach($words as $word) {
            $thisWordCount = strlen($word);
            if($lineWordCount + $thisWordCount + 1 > $maxWidth) {
                // Si le mot dépasse le cadre, on passe à la ligne suivante
                $currentLine++;
                $lineWordCount = 0;
                $y += $lineBreakSpacing;
            }
            // Sinon, on continue le mot comme il faut, en ajoutant un espace...
            $word = str_repeat(' ', $lineWordCount) . $word;
            $lineWordCount += $thisWordCount + 1;
            $this->writeWithSpacing($word, $x, $y, $spacing);
        }
    }

    private function printSalarieTelephone(Field $field) : void
    {
        $x = 25.1;
        $y = 194.3;
        $telephone = str_split($field->getValue());
        // str_split() enlève le '0' initial du numéro...
        array_unshift($telephone, '0');
        foreach($telephone as $i => $chiffre) {
            $this->getFpdi()->cell(3, 5, $chiffre);
            if($i % 2 == 0) $x += 5.6;
            else            $x += 4;
            $this->getFpdi()->setXY($x, $y);
        }
    }
}
