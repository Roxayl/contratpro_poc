<?php

namespace App\Services\Cerfa;

use App\Services\CerfaPrinter\Printable;
use Illuminate\Support\Str;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader\PageBoundaries;

class CerfaPdfGenerator
{
    private string $pdfFile;
    private Printable $printer;
    private Cerfa $cerfa;
    private Fpdi $pdf;

    public function __construct(Cerfa $cerfa, Printable $printer, string $pdfFile)
    {
        $this->cerfa = $cerfa;
        $this->pdfFile = $pdfFile;
        $this->printer = $printer;
    }

    public function initializePdf()
    {
        $pdf = new Fpdi();
		$pageCount = $pdf->setSourceFile($this->pdfFile);
		$pdf->SetFont('Courier','',12);
		$pdf->SetAutoPageBreak(true, 0);
		$this->pdf = $pdf;
    }

    public function fillPdf()
    {
        $pages = $this->cerfa->getPages();

        foreach($pages as $pageNo => $page) {

            // On créé une nouvelle page, et charge la page depuis le pdf d'origine...
            $this->pdf->addPage();
		    $pageId = $this->pdf->importPage($pageNo, PageBoundaries::MEDIA_BOX);
            $this->pdf->useImportedPage($pageId, 0, 0);

            // On parcourt chaque champ, histoire d'essayer de les ajouter dans le pdf...e
            foreach($page->getFields() as $field) {
                // Obtenir le nom de la méthode printer pour ce champ
                $fieldPrinterName = 'print' . Str::camel(Str::ucfirst($field->getName()));

                // Si la méthode printer existe, on l'appelle
                if($this->printer->hasPrinterMethod($fieldPrinterName)) {
                    $fieldPrinterName();
                }

                // Sinon, on imprime le champ de manière "standard", selon les données de configuration
                else {
                    // standard
                }
            }

        }
    }
}
