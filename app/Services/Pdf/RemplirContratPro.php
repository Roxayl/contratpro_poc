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
    protected float $defaultSpacing = 4.16;

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

		$this->pdf->SetFont('Courier','',12);

		$this->model = $model;
	}

    /**
     * Remplir le formulaire PDF avec les données issues du modèle.
     */
    public function fill() : void
    {
        $this->executePrint();
    }

    private function writeWithSpacing(?string $str, float $x, float $y, ?float $spacing = null) : void
    {
        if($spacing === null) {
            $spacing = $this->defaultSpacing;
        }
        $arr = str_split(strtoupper($str));
        $this->pdf->setXY($x, $y);
        foreach($arr as $key => $char) {
            $this->pdf->cell(3, 5, $char);
            $x += $spacing;
            $this->pdf->setX($x);
        }
    }

	private function printDenomination() : void
    {
        $this->writeWithSpacing($this->model->employeur->denomination, 9.1, 62.5);
    }

    private function printNoAdresse() : void
    {
        $this->writeWithSpacing($this->model->employeur->noAdresse, 17, 77.5);
    }

    private function printVoieAdresse() : void
    {
        $this->writeWithSpacing($this->model->employeur->voieAdresse, 54, 77.5);
    }

    private function printComplementAdresse() : void
    {
        $this->writeWithSpacing($this->model->employeur->complementAdresse, 34, 83.7);
    }

    private function printCodePostalEmployeur() : void
    {
        $this->writeWithSpacing($this->model->employeur->codePostal, 33, 90);
    }

    private function printCommuneEmployeur() : void
    {
        $this->writeWithSpacing($this->model->employeur->commune, 30.1, 96.2);
    }

    private function printTelephoneEmployeur() : void
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

    private function printCourrielEmployeur() : void
    {
        $spacing = 3.45;
        $array = explode("@", strtoupper($this->model->employeur->courriel));
        $user = $array[0];
        $domain = $array[1];
        $this->writeWithSpacing($user, 8.6, 113.6, $spacing);
        $this->writeWithSpacing($domain, 61, 113.6, $spacing);
    }
}
