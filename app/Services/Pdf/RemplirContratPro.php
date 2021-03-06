<?php

namespace App\Services\Pdf;

use App\Models\ContratPro;
use App\Services\Pdf\Contracts\PdfService;
use App\Services\Pdf\Traits\PdfServiceTrait;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader\PageBoundaries;

class RemplirContratPro implements PdfService
{
    use PdfServiceTrait;

    protected string $file = 'pdf/cerfa_12434-03.pdf';

    /**
     * Créé une instance de <code>RemplirContratPro</code>.
     * @param ContratPro $model Le modèle agrégant les données du formulaire PDF.
     * @throws \setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException
     * @throws \setasign\Fpdi\PdfParser\Filter\FilterException
     * @throws \setasign\Fpdi\PdfParser\PdfParserException
     * @throws \setasign\Fpdi\PdfParser\Type\PdfTypeException
     * @throws \setasign\Fpdi\PdfReader\PdfReaderException
     */
	public function __construct(ContratPro $model)
	{
		$this->pdf = new Fpdi();

		$pageCount = $this->pdf->setSourceFile(public_path($this->file));
		$pageId = $this->pdf->importPage(1, PageBoundaries::MEDIA_BOX);

		$this->pdf->addPage();
		$this->pdf->useImportedPage($pageId, 0, 0);

		$this->pdf->SetFont('Helvetica','',12);

		$this->model = $model;
	}

    /**
     * Remplir le formulaire PDF avec les données issues du modèle.
     */
    public function fill()
    {
        $this->executePrint();
    }

	private function printNomPrenom()
    {
        $this->pdf->setXY(9.5, 62.7);
        $this->pdf->cell(101, 5,
            utf8_decode($this->model->employeur->denomination));
    }

    private function printNoAdresse()
    {
        $this->pdf->setXY(17, 77.5);
        $this->pdf->cell(50, 5,
            utf8_decode($this->model->employeur->noAdresse));
    }

    private function printVoieAdresse()
    {
        $this->pdf->setXY(54, 77.5);
        $this->pdf->cell(70, 5,
            utf8_decode($this->model->employeur->voieAdresse));
    }

    private function printComplementAdresse()
    {
        $this->pdf->setXY(34, 84);
        $this->pdf->cell(70, 5,
            utf8_decode($this->model->employeur->complementAdresse));
    }

    private function printCodePostalEmployeur()
    {
        $this->pdf->setXY(33, 90);
        $this->pdf->cell(70, 5,
            utf8_decode($this->model->employeur->codePostal));
    }

    private function printCommuneEmployeur()
    {
        $this->pdf->setXY(31, 96.5);
        $this->pdf->cell(70, 5,
            utf8_decode($this->model->employeur->commune));
    }

    private function printTelephoneEmployeur()
    {
        $x = 25;
        $y = 103.5;
        $telephone = str_split($this->model->employeur->telephone);
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
