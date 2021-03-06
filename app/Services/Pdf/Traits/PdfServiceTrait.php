<?php

namespace App\Services\Pdf\Traits;

trait PdfServiceTrait
{
    /**
     * Cette méthode va exécuter toutes les méthodes commençant par
     * "print". Les méthodes print* contiennent toute la logique pour
     * intégrer une propriété d'un modèle dans le formulaire PDF.
     */
    protected function executePrint() : void
    {
        $methods = get_class_methods($this);
        foreach($methods as $method) {
            if(substr($method, 0, 5 ) === "print") {
                $this->$method();
            }
        }
    }

    /**
     * Affiche le formulaire PDF généré.
     */
    public function output() : void
    {
        $this->pdf->Output();
    }
}
