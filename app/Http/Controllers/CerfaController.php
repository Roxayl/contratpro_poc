<?php

namespace App\Http\Controllers;

use App\Services\Cerfa\Cerfa;
use App\Services\Cerfa\CerfaConfig;
use App\Services\Cerfa\CerfaPdfGenerator;
use App\Services\Printers\CerfaPrinter12434_03;
use Illuminate\Http\Request;

class CerfaController extends Controller
{
    public function form(Request $request)
    {
        $cerfaConfig = new CerfaConfig();
        $cerfaConfig->loadFromFile(base_path('resources/cerfa/cerfa.json'));

        $cerfa = new Cerfa($cerfaConfig);
        return view('cerfa.form')->with('content', $cerfa->generateForm());
    }

    public function generate(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
        } else {
            $data = $this->getData();
        }

        // On charge les données depuis le json !
        $cerfaConfig = new CerfaConfig();
        $cerfaConfig->loadFromFile(base_path('resources/cerfa/cerfa.json'));

        // Créer un objet Cerfa
        $cerfa = new Cerfa($cerfaConfig);

        // Ajouter les données...
        $cerfa->hydrateData($data);

        // Génération du PDF !
        // Emplacement du fichier pdf
        $pdfPath = public_path('pdf/cerfa_' . $cerfaConfig->getConfig()->cerfa . '.pdf');
        // Printer contient les méthodes spécifiques au formulaire Cerfa pour gérer certains champs.
        $printer = new CerfaPrinter12434_03($cerfa);
        // PdfGenerator correspond à la classe permettant de gérer l'impression d'un PDF. Elle utilise un
        // printer pour gérer l'impression de certains champs qui nécessitent une logique plus compliquée.
        $pdfGenerator = new CerfaPdfGenerator($cerfa, $pdfPath, $printer);

        // On définit le générateur de PDF...
        $cerfa->setGenerator($pdfGenerator);

        // Impression !
        $cerfa->generatePdf();
    }

    private function getData(): array
    {
        return [
            'employeurDenomination' => 'WAM',
            'employeurNoAdresse' => '23',
            'employeurVoieAdresse' => "Rue",
            'employeurComplementAdresse' => "Major Montricher",
            'employeurCodePostal' => "20000",
            'employeurCommune' => "Ajaccio",
            'employeurTelephone' => "0495208678",
            'employeurCourriel' => 'romu_fabiani@yahoo.fr',
            'employeurCaisseRetraiteComplementaire' => 'Agirc',
            'employeurOrgPrevoyance' => 'Test',
            'employeurParticulierEmployeur' => 'non',
            'employeurUrssafParticulierEmployeur' => 'test',
            'employeurSiret' => "36252187900034",
            'employeurNaf' => "43273",
            'employeurEffectif' => "33",
            'employeurConventionCollective' => "commerces de détail non alimentaires",
            'employeurIdcc' => "4329",

            'salarieNom' => "Nicolas",
            'salariePrenom' => "Quentin",
            'salarieNoAdresse' => "45",
            "salarieVoieAdresse" => "Rue des Peupliers",
            "salarieComplementAdresse" => "N/A",
            "salarieCodePostal" => '13010',
            "salarieCommune" => 'Marseille',
            'salarieTelephone' => "068906158",
            'salarieCourriel' => 'qnicolas@gmail.com',
            'salarieNirSalarie' => '136469',
            'salarieDateNaissance' => '03/02/1996',
            'salarieSexe' => 'M',
            'salarieRqth' => true,
            'salarieInscritPoleEmploi' => true,
            'salarieNoPoleEmploi' => '45134512',
            'salarieDureePoleEmploi' => '5',
            'salarieSituationAvantContrat' => 'NA',
            'salarieTypeMinimumSocial' => 'Q',
            'salarieDiplomePlusEleveObtenu' => 'AA',

            'tuteurNom' => "Monique",
            'tuteurPrenom' => "Rolbert",
            'tuteurEmploi' => "Maître de conférences",
            'tuteurDateNaissance' => "19/06/1986",
            'tuteurUtilNom' => "Dupont",
            'tuteurUtilPrenom' => "Jean",
            'tuteurUtilEmploi' => "Président",
            'tuteurUtilDateNaissance' => "03/12/1977"
        ];
    }
}
