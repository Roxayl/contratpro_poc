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

	private function printEmployeurDenomination() : void
    {
        $this->writeWithSpacing($this->model->employeur->denomination, 9.1, 62.5);
    }

    private function printEmployeurNoAdresse() : void
    {
        $this->writeWithSpacing($this->model->employeur->noAdresse, 17, 77.5);
    }

    private function printEmployeurVoieAdresse() : void
    {
        $this->writeWithSpacing($this->model->employeur->voieAdresse, 54, 77.5);
    }

    private function printEmployeurComplementAdresse() : void
    {
        $this->writeWithSpacing($this->model->employeur->complementAdresse, 34, 83.7);
    }

    private function printEmployeurCodePostal() : void
    {
        $this->writeWithSpacing($this->model->employeur->codePostal, 33, 90);
    }

    private function printEmployeurCommune() : void
    {
        $this->writeWithSpacing($this->model->employeur->commune, 30.1, 96.2);
    }

    private function printEmployeurTelephone() : void
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

    private function printEmployeurCourriel() : void
    {
        $spacing = 3.45;
        $array = explode("@", strtoupper($this->model->employeur->courriel));
        $user = $array[0];
        $domain = $array[1];
        $this->writeWithSpacing($user, 8.6, 113.6, $spacing);
        $this->writeWithSpacing($domain, 61, 113.6, $spacing);
    }

    private function printEmployeurCaisseRetraiteComplementaire() : void
    {
        $this->writeWithSpacing($this->model->employeur->caisseRetraiteComplementaire, 8.6, 123.8);
    }

    private function printEmployeurOrgPrevoyance() : void
    {
        $this->writeWithSpacing($this->model->employeur->orgPrevoyance, 8.6, 135.8);
    }

    private function printEmployeurParticulier() : void
    {
        if($this->model->employeur->particulierEmployeur)
            $this->writeWithSpacing('X', 146.2, 62.2);
        else
            $this->writeWithSpacing('X', 165.2, 62.2);
    }

    private function printEmployeurUrssafParticulier() : void
    {
        $this->writeWithSpacing($this->model->employeur->urssafParticulierEmployeur, 106.2, 73);
    }

    private function printEmployeurSiret() : void
    {
        $this->writeWithSpacing($this->model->employeur->siret, 106.2, 88.2);
    }
}
