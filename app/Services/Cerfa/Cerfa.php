<?php

namespace App\Services\Cerfa;

use Illuminate\Support\Arr;
use stdClass;

class Cerfa
{
    private ?string $id;
    private array $pages;
    private stdClass $globals;
    private ?CerfaConfig $cerfaConfig;
    private int $pageCount = 0;
    private ?CerfaPdfGenerator $pdfGenerator = null;

    public function __construct(CerfaConfig $cerfaConfig)
    {
        $this->cerfaConfig = $cerfaConfig;
        $this->id = $this->cerfaConfig->getConfig()->cerfa;
        $this->globals = $this->cerfaConfig->getConfig()->globals;
        $this->pages = [];

        $this->initialize();
    }

    private function initialize(): void
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

    private function addPage(Page $page, ?int $index = null): void
    {
        if($index == null)
            $index = $this->pageCount + 1;
        $this->pages[$index] = $page;
        $this->pageCount = count($this->pages);
    }

    public function hydrateData(array $data): void
    {
        foreach($this->pages as $page) {
            foreach($data as $fieldName => $value) {
                if($page->hasField($fieldName)) {
                    $page->getField($fieldName)->setValue($value);
                }
            }
        }
    }

    public function generateForm(): string
    {
        $output = '';
        foreach($this->pages as $page) {
            foreach($page->getFields() as $field) {
                $output .= view('cerfa.' . $field->getType(), $field->getArray())->render();
            }
        }
        return $output;
    }

    public function hasGlobal($dot): bool
    {
        return Arr::has( (array)$this->globals, $dot);
    }

    public function getGlobal($dot)
    {
        return Arr::get( (array)$this->globals, $dot);
    }

    /**
     * @return Page[]|array
     */
    public function getPages(): array
    {
        return $this->pages;
    }

    public function setGenerator(CerfaPdfGenerator $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    public function generatePdf(string $dest = '', string $name = '', $isUTF8 = false)
    {
        $this->pdfGenerator->fillPdf();
        $this->pdfGenerator->output($dest, $name, $isUTF8);
    }

    public function getPdfGenerator(): ?CerfaPdfGenerator
    {
        return $this->pdfGenerator;
    }
}
