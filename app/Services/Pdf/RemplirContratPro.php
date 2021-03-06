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
}
