<?php

namespace App\Services\Pdf;

use App\Models\ContratPro;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader\PageBoundaries;

class RemplirContratPro extends PdfService
{
    protected string $file = 'pdf/cerfa_12434-03.pdf';

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

    public function fill()
    {
        $this->setNomPrenom();
    }

	public function setNomPrenom()
    {
        $this->pdf->setXY(9.5, 62.7);
        $this->pdf->cell(101, 5,
            utf8_decode($this->model->employeur->denomination));
    }
}
