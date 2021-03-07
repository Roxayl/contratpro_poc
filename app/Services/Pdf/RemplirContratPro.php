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
    private ContratPro $model;

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
		$this->pdf->SetAutoPageBreak(true, 0);

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

    private function printEmployeurNaf() : void
    {
        $this->writeWithSpacing($this->model->employeur->naf, 169, 94.2);
    }

    private function printEmployeurEffectif() : void
    {
        $this->writeWithSpacing($this->model->employeur->effectif, 106.2, 105);
    }

    private function printEmployeurConventionCollective() : void
    {
        $maxWidth = 22;
        $words = explode(" ", utf8_decode($this->model->employeur->conventionCollective));
        $lineBreakSpacing = 6.7;
        $x = 106.3;
        $y = 117;
        $currentLine = 1;
        $lineWordCount = 0;
        foreach($words as $word) {
            $thisWordCount = strlen($word);
            if($lineWordCount + $thisWordCount + 1 > $maxWidth) {
                // Si le mot dépasse le cadre, on passe à la ligne suivante
                $currentLine++;
                $lineWordCount = 0;
                $y += $lineBreakSpacing;
            } else {
                // Sinon, on continue le mot comme il faut, en ajoutant un espace...
                $word = str_repeat(' ', $lineWordCount) . $word;
                $lineWordCount += $thisWordCount + 1;
            }
            $this->writeWithSpacing($word, $x, $y);
        }
    }

    private function printEmployeurIdcc() : void
    {
        $this->writeWithSpacing($this->model->employeur->idcc, 158.7, 131.2);
    }

    private function printSalarieNom() : void
    {
        $this->writeWithSpacing($this->model->salarie->nom, 40, 150.2);
    }

    private function printSalariePrenom() : void
    {
        $this->writeWithSpacing($this->model->salarie->prenom, 45.2, 156.2);
    }

    private function printSalarieNoAdresse() : void
    {
        $this->writeWithSpacing($this->model->salarie->noAdresse, 12.9, 169.4);
    }

    private function printSalarieVoieAdresse() : void
    {
        $this->writeWithSpacing($this->model->salarie->voieAdresse, 38, 169.4);
    }

    private function printSalarieComplementAdresse() : void
    {
        $this->writeWithSpacing($this->model->salarie->complementAdresse, 34.3, 175.6);
    }

    private function printSalarieCodePostal() : void
    {
        $this->writeWithSpacing($this->model->salarie->codePostal, 32.8, 181.7);
    }

    private function printSalarieCommune() : void
    {
        $this->writeWithSpacing($this->model->salarie->commune, 30.2, 187.8);
    }

    private function printSalarieTelephone() : void
    {
        $x = 25.1;
        $y = 194.3;
        $telephone = str_split($this->model->employeur->telephone);
        // str_split() enlève le '0' initial du numéro...
        array_unshift($telephone, '0');
        foreach($telephone as $i => $chiffre) {
            $this->pdf->cell(3, 5, $chiffre);
            if($i % 2 == 0) $x += 5.6;
            else            $x += 4;
            $this->pdf->setXY($x, $y);
        }
    }

    private function printSalarieCourriel() : void
    {
        if(empty($this->model->salarie->courriel)) return;
        $spacing = 3.45;
        $array = explode("@", strtoupper($this->model->salarie->courriel));
        $user = $array[0];
        $domain = $array[1];
        $this->writeWithSpacing($user, 8.6, 204.5, $spacing);
        $this->writeWithSpacing($domain, 61.2, 204.5, $spacing);
    }

    private function printSalarieNirSalarie() : void
    {
        $this->writeWithSpacing($this->model->salarie->nirSalarie, 38.3, 210.6);
    }

    private function printSalarieDateNaissance() : void
    {
        $str = $this->model->salarie->dateNaissance;
        if(empty($str)) return;
        $jour = (string)($str[0] . $str[1]);
        $mois = (string)($str[3] . $str[4]);
        $annee = (string)(substr($str, -4));
        $this->writeWithSpacing($jour, 44, 223);
        $this->writeWithSpacing($mois, 56.4, 223);
        $this->writeWithSpacing($annee, 68.7, 223);
    }

    private function printSalarieSexe() : void
    {
        $str = 'X';
        $x = 21;
        $y = 227.7;
        if($this->model->salarie->sexe === "F") {
            $x = 30.5;
        }
        $this->writeWithSpacing($str, $x, $y);
    }

    private function printSalarieRqth() : void
    {
        $str = 'X';
        $x = 146.6;
        $y = 172.6;
        if($this->model->salarie->rqth) {
            $x = 127.4;
        }
        $this->writeWithSpacing($str, $x, $y);
    }

    private function printSalarieInscritPoleEmploi() : void
    {
        $str = 'X';
        $x = 164;
        $y = 181.9;
        if($this->model->salarie->inscritPoleEmploi) {
            $x = 145;
        }
        $this->writeWithSpacing($str, $x, $y);
    }

    private function printSalarieNoPoleEmploi() : void
    {
        $this->writeWithSpacing($this->model->salarie->noPoleEmploi, 156.4, 188.2);
    }

    private function printSalarieDureePoleEmploi() : void
    {
        $this->writeWithSpacing($this->model->salarie->dureePoleEmploi, 120.5, 193.5);
    }

    private function printSalarieSituationAvantContrat() : void
    {
        $this->writeWithSpacing($this->model->salarie->situationAvantContrat, 153.5, 202.7);
    }

    private function printSalarieTypeMinimumSocial() : void
    {
        $this->writeWithSpacing($this->model->salarie->typeMinimumSocial, 177.1, 208.6);
    }

    private function printSalarieDiplomePlusEleveObtenu() : void
    {
        $this->writeWithSpacing($this->model->salarie->diplomePlusEleveObtenu, 172.4, 214.8);
    }

    private function printTuteurNom() : void
    {
        $this->writeWithSpacing($this->model->tuteur->nom, 8.6, 253.5);
    }

    private function printTuteurPrenom() : void
    {
        $this->writeWithSpacing($this->model->tuteur->prenom, 8.6, 264);
    }

    private function printTuteurEmploi() : void
    {
        $this->writeWithSpacing(utf8_decode($this->model->tuteur->emploi), 8.8, 276);
    }

    private function printTuteurDateNaissance() : void
    {
        $str = $this->model->tuteur->dateNaissance;
        if(empty($str)) return;
        $jour = (string)($str[0] . $str[1]);
        $mois = (string)($str[3] . $str[4]);
        $annee = (string)(substr($str, -4));
        $this->writeWithSpacing($jour, 44, 282.5);
        $this->writeWithSpacing($mois, 56.4, 282.5);
        $this->writeWithSpacing($annee, 68.7, 282.5);
    }

    private function printTuteurUtilNom() : void
    {
        $this->writeWithSpacing($this->model->tuteur->utilNom, 106.3, 253.5);
    }

    private function printTuteurUtilPrenom() : void
    {
        $this->writeWithSpacing($this->model->tuteur->utilPrenom, 106.3, 264);
    }

    private function printTuteurUtilEmploi() : void
    {
        $this->writeWithSpacing(utf8_decode($this->model->tuteur->utilEmploi), 106.3, 276);
    }

    private function printTuteurUtilDateNaissance() : void
    {
        $str = $this->model->tuteur->utilDateNaissance;
        if(empty($str)) return;
        $jour = (string)($str[0] . $str[1]);
        $mois = (string)($str[3] . $str[4]);
        $annee = (string)(substr($str, -4));
        $this->writeWithSpacing($jour, 141.7, 282.5);
        $this->writeWithSpacing($mois, 154.1, 282.5);
        $this->writeWithSpacing($annee, 166.4, 282.5);
    }
}
