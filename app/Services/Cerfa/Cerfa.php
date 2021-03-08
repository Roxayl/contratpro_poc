<?php

namespace App\Services\Cerfa;

use Illuminate\Http\Response;

class Cerfa
{
    private ?string $id;
    private array $pages;
    private ?CerfaConfig $cerfaConfig;
    private int $pageCount = 1;

    public function __construct(CerfaConfig $cerfaConfig)
    {
        $this->id =
        $this->cerfaConfig = $cerfaConfig;
        $this->pages = [];

        $this->initialize();
    }

    private function initialize()
    {
        $config = $this->cerfaConfig->getConfig();

        $this->id = $config->cerfa;
        foreach($config->pages as $noPage => $configPage) {
            $page = new Page($noPage);
            foreach($configPage->fields as $configField) {
                $field = new Field($configField);
                $page->addField($field);
            }
            $this->addPage($page);
            $this->pageCount++;
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
