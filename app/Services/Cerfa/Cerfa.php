<?php

namespace App\Services\Cerfa;

use Illuminate\Http\Response;

class Cerfa
{
    private ?string $id = '';
    private array $pages = [];
    private ?CerfaConfig $cerfaConfig = null;
    private int $pageCount = 1;

    public function __construct(CerfaConfig $cerfaConfig)
    {
        $this->cerfaConfig = $cerfaConfig;
        $this->initialize();
    }

    private function initialize()
    {
        $config = $this->cerfaConfig->getConfig();

        $this->id = $config->cerfa;
        foreach($config->pages as $configPage) {
            $page = new Page();
            foreach($configPage->fields as $configField) {
                $field = new Field($configField);
            }
        }
    }

    private function addPage(Page $page, ?int $index = null)
    {
        if($index == null)
            $index = $this->pageCount + 1;
        $this->pages[$index] = $page;
        $this->pageCount = count($this->pages);
    }

    public function hydrateData(array $data) : void
    {
        // Ajoute les données d'un tableau
    }

    public function generateForm() : string
    {
        return '';
    }

    public function generatePdf() : Response
    {
        return response();
    }
}
