@extends('layouts.app')

@section('title')
    Créer un contrat de professionnalisation
@endsection

@section('content')

    @parent

    <form method="POST" action="{{ route('contrat.create') }}" class="col-lg-8 offset-lg-2">
        @csrf

        <h3>Employeur</h3>

        <div class="form-group md-3 my-2">
            <label for="employeur[denomination]">Nom et prénom ou dénomination de l'employeur</label>
            <input name="employeur[denomination]" id="employeur[denomination]" type="text" class="form-control">
        </div>

        <div class="row">
            <div class="form-group col-sm-3">
                <label for="employeur[noAdresse]">N° Adresse</label>
                <input name="employeur[noAdresse]" id="employeur[noAdresse]" type="text" class="form-control"
                    placeholder="69">
            </div>

            <div class="form-group col-sm-9">
                <label for="employeur[voieAdresse]">Voie adresse</label>
                <input name="employeur[voieAdresse]" id="employeur[voieAdresse]" type="text" class="form-control">
            </div>
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[complementAdresse]">Complément adresse</label>
            <input name="employeur[complementAdresse]" id="employeur[complementAdresse]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[codePostal]">Code postal</label>
            <input name="employeur[codePostal]" id="employeur[codePostal]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[commune]">Commune</label>
            <input name="employeur[commune]" id="employeur[commune]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[telephone]">Téléphone</label>
            <input name="employeur[telephone]" id="employeur[telephone]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[courriel]">Courriel</label>
            <input name="employeur[courriel]" id="employeur[courriel]" type="text" class="form-control"
                placeholder="user@domain.com">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[caisseRetraiteComplementaire]">Caisse de retraite complémentaire</label>
            <input name="employeur[caisseRetraiteComplementaire]" id="employeur[caisseRetraiteComplementaire]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[orgPrevoyance]">Organisme de prévoyance (si applicable)</label>
            <input name="employeur[orgPrevoyance]" id="employeur[orgPrevoyance]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[particulierEmployeur]">Particulier-employeur ?</label>
            <input name="employeur[particulierEmployeur]" id="employeur[particulierEmployeur]" type="checkbox" value="1">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[urssafParticulierEmployeur]">N° URSSAF du particulier-employeur</label>
            <input name="employeur[urssafParticulierEmployeur]" id="employeur[urssafParticulierEmployeur]" type="text" class="form-control"
                placeholder="14 caractères, commençant par '08', '09', 'X', ou 'Z'">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[siret]">N° SIRET</label>
            <input name="employeur[siret]" id="employeur[siret]" type="text" class="form-control"
                placeholder="14 chiffres">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[naf]">NAF</label>
            <input name="employeur[naf]" id="employeur[naf]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[effectif]">Effectif total de l'entreprise</label>
            <input name="employeur[effectif]" id="employeur[effectif]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[conventionCollective]">Convention collective applicable</label>
            <input name="employeur[conventionCollective]" id="employeur[conventionCollective]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="employeur[idcc]">Code IDCC de la convention</label>
            <input name="employeur[idcc]" id="employeur[idcc]" type="text" class="form-control"
                placeholder="4 chiffres">
        </div>


        <h2>Salarié</h2>

        <div class="form-group md-3 my-2">
            <label for="salarie[nom]">Nom du salarié</label>
            <input name="salarie[nom]" id="salarie[nom]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[prenom]">Prénom du salarié</label>
            <input name="salarie[prenom]" id="salarie[prenom]" type="text" class="form-control">
        </div>

        <div class="row">
            <div class="form-group col-sm-3">
                <label for="salarie[noAdresse]">Numéro adresse</label>
                <input name="salarie[noAdresse]" id="salarie[noAdresse]" type="text" class="form-control">
            </div>

            <div class="form-group col-sm-9">
                <label for="salarie[voieAdresse]">Voie adresse</label>
                <input name="salarie[voieAdresse]" id="salarie[voieAdresse]" type="text" class="form-control">
            </div>
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[complementAdresse]">Complément adresse</label>
            <input name="salarie[complementAdresse]" id="salarie[complementAdresse]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[codePostal]">Code postal</label>
            <input name="salarie[codePostal]" id="salarie[codePostal]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[commune]">Commune</label>
            <input name="salarie[commune]" id="salarie[commune]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[telephone]">Téléphone</label>
            <input name="salarie[telephone]" id="salarie[telephone]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[courriel]">Courriel</label>
            <input name="salarie[courriel]" id="salarie[courriel]" type="text" class="form-control"
                placeholder="user@domain.com">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[nirSalarie]">NIR du salarié <br>
            <small>Pour les employeurs du secteur privé dans le cadre de l’article L.6353-10 du code du travail</small></label>
            <input name="salarie[nirSalarie]" id="salarie[nirSalarie]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[dateNaissance]">Date de naissance</label>
            <input name="salarie[dateNaissance]" id="salarie[dateNaissance]" type="text" class="form-control"
                placeholder="31/12/1970">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[sexe]">Sexe</label>
            <input name="salarie[sexe]" id="salarie[sexe]" type="text" class="form-control"
                placeholder="M/F">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[rqth]">RQTH ?</label>
            <input name="salarie[rqth]" id="salarie[rqth]" type="checkbox" value="1">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[inscritPoleEmploi]">Inscrit Pole Emploi ?</label>
            <input name="salarie[inscritPoleEmploi]" id="salarie[inscritPoleEmploi]" type="checkbox" value="1">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[noPoleEmploi]">No Pole Emploi</label>
            <input name="salarie[noPoleEmploi]" id="salarie[noPoleEmploi]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[dureePoleEmploi]">Inscrit à Pole Emploi depuis (en mois)</label>
            <input name="salarie[dureePoleEmploi]" id="salarie[dureePoleEmploi]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[situationAvantContrat]">Situation avant contrat</label>
            <input name="salarie[situationAvantContrat]" id="salarie[situationAvantContrat]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[typeMinimumSocial]">Type de minimum social, si bénéficiaire</label>
            <input name="salarie[typeMinimumSocial]" id="salarie[typeMinimumSocial]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="salarie[diplomePlusEleveObtenu]">Diplôme le plus élevé obtenu</label>
            <input name="salarie[diplomePlusEleveObtenu]" id="salarie[diplomePlusEleveObtenu]" type="text" class="form-control">
        </div>


        <h2>Tuteur</h2>

        <h3>Tuteur au sein de l'établissement employeur</h3>

        <div class="form-group md-3 my-2">
            <label for="tuteur[nom]">Nom</label>
            <input name="tuteur[nom]" id="tuteur[nom]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="tuteur[prenom]">Prénom</label>
            <input name="tuteur[prenom]" id="tuteur[prenom]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="tuteur[emploi]">Emploi occupé</label>
            <input name="tuteur[emploi]" id="tuteur[emploi]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="tuteur[dateNaissance]">Date de naissance</label>
            <input name="tuteur[dateNaissance]" id="tuteur[dateNaissance]" type="text" class="form-control"
                placeholder="31/12/1970">
        </div>


        <h3>Tuteur de l'entreprise utilisatrice, <strong>si travail temporaire ou GEIQ</strong></h3>

        <div class="form-group md-3 my-2">
            <label for="tuteur[utilNom]">Nom</label>
            <input name="tuteur[utilNom]" id="tuteur[utilNom]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="tuteur[utilPrenom]">Prénom</label>
            <input name="tuteur[utilPrenom]" id="tuteur[utilPrenom]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="tuteur[utilEmploi]">Emploi occupé</label>
            <input name="tuteur[utilEmploi]" id="tuteur[utilEmploi]" type="text" class="form-control">
        </div>

        <div class="form-group md-3 my-2">
            <label for="tuteur[utilDateNaissance]">Date de naissance</label>
            <input name="tuteur[utilDateNaissance]" id="tuteur[utilDateNaissance]" type="text" class="form-control"
                placeholder="31/12/1970">
        </div>

        <button class="btn btn-primary my-3" type="submit">Envoyer</button>
    </form>

@endsection
