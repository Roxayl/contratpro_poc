<?php

namespace App\Services\Pdf;

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader\PageBoundaries;

class RemplirContratPro
{
    private $pdf;
    private string $file = 'pdf/cerfa_13751.pdf';

	public function __construct()
	{
		$this->pdf = new Fpdi();

		$pageCount = $this->pdf->setSourceFile(public_path($this->file));
		$pageId = $this->pdf->importPage(1, PageBoundaries::MEDIA_BOX);

		$this->pdf->addPage();
		$this->pdf->useImportedPage($pageId, 0, 0);

		$this->pdf->SetFont('Helvetica','',12);
	}
}
