<?php

namespace App\Services\Cerfa;

use Illuminate\Support\Arr;

class Cerfa
{
    private ?string $id;
    private array $pages;
    private \stdClass $globals;
    private ?CerfaConfig $cerfaConfig;
    private int $pageCount = 0;

    public function __construct(CerfaConfig $cerfaConfig)
    {
        $this->cerfaConfig = $cerfaConfig;
        $this->id = $this->cerfaConfig->getConfig()->cerfa;
        $this->globals = $this->cerfaConfig->getConfig()->globals;
        $this->pages = [];

        $this->initialize();
    }

    private function initialize()
    {
        $config = $this->cerfaConfig->getConfig();

        $this->id = $config->cerfa;
        foreach($config->pages as $noPage => $configPage) {
            $page = new Page($noPage);
            foreach($configPage->fields as $nameField => $configField) {
                $field = Field::create($nameField, $configField, $this);
                $page->addField($field);
            }
            $this->addPage($page);
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
        $output = '';
        foreach($this->pages as $page) {
            foreach($page->getFields() as $field) {
                $output .= view('cerfa.' . $field->getType(), $field->getArray())->render();
            }
        }
        return $output;
    }

    public function generatePdf()
    {
        //
    }

    public function hasGlobal($dot) : bool
    {
        return Arr::has( (array)$this->globals, $dot );
    }

    public function getGlobal($dot)
    {
        return Arr::get( (array)$this->globals, $dot );
    }

    public function getPages(): array
    {
        return $this->pages;
    }
}
