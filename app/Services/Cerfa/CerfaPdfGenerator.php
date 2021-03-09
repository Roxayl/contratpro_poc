<?php

namespace App\Services\Cerfa;

use App\Services\CerfaPrinter\CerfaPrinter;
use Illuminate\Support\Str;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader\PageBoundaries;

class CerfaPdfGenerator
{
    private Cerfa $cerfa;
    private string $pdfFile;
    private ?CerfaPrinter $printer;
    private ?Fpdi $fpdi = null;

    public function __construct(Cerfa $cerfa, string $pdfFile, CerfaPrinter $printer = null)
    {
        $this->cerfa = $cerfa;
        $this->pdfFile = $pdfFile;
        $this->printer = $printer;
        $this->initializeFpdi();
    }

    private function initializeFpdi(): void
    {
        $pdf = new Fpdi();
		$pageCount = $pdf->setSourceFile($this->pdfFile);
		$pdf->SetFont('Courier','',12);
		$pdf->SetAutoPageBreak(true, 0);
		$this->fpdi = $pdf;
    }

    public function getFpdi(): Fpdi
    {
        return $this->fpdi;
    }

    public function fillPdf(): void
    {
        $pages = $this->cerfa->getPages();

        foreach($pages as $pageNo => $page) {

            // On créé une nouvelle page, et charge la page depuis le pdf d'origine...
            $this->fpdi->addPage();
		    $pageId = $this->fpdi->importPage($pageNo, PageBoundaries::MEDIA_BOX);
            $this->fpdi->useImportedPage($pageId, 0, 0);

            // On parcourt chaque champ, histoire d'essayer de les ajouter dans le pdf...e
            foreach($page->getFields() as $field) {
                // Obtenir le nom de la méthode printer pour ce champ
                $fieldPrinterName = 'print' . Str::ucfirst(Str::camel($field->getName()));

                // Si la méthode printer existe, on l'appelle
                if(!is_null($this->printer) && $this->printer->hasPrinterMethod($fieldPrinterName)) {
                    $this->printer->$fieldPrinterName($field);
                }

                // Sinon, on imprime le champ de manière "standard", selon les données de configuration
                else {
                    $this->printer->print($field);
                }
            }

        }
    }

    public function output(string $dest = '', string $name = '', $isUTF8 = false): void
    {
        $this->fpdi->Output($dest, $name, $isUTF8);
    }
}
