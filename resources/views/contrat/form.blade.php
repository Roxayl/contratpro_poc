@extends('layouts.app')

@section('title')
    Créer un contrat de professionnalisation
@endsection

@section('content')

    @parent

    <form method="POST" action="{{ route('contrat.create') }}">
        @csrf

        <h3>Employeur</h3>

        <div class="md-3">
            <label for="employeur[denomination]">Nom et prénom ou dénomination de l'employeur</label>
            <input name="employeur[denomination]" id="employeur[denomination]" type="text" class="form-control">
        </div>

        <div class="row">
            <div class="col-sm-3">
                <label for="employeur[noAdresse]">N° Adresse</label>
                <input name="employeur[noAdresse]" id="employeur[noAdresse]" type="text" class="form-control">
            </div>

            <div class="col-sm-9">
                <label for="employeur[voieAdresse]">Voie adresse</label>
                <input name="employeur[voieAdresse]" id="employeur[voieAdresse]" type="text" class="form-control">
            </div>
        </div>

        <div class="md-3">
            <label for="employeur[complementAdresse]">Complément adresse</label>
            <input name="employeur[complementAdresse]" id="employeur[complementAdresse]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[codePostal]">Code postal</label>
            <input name="employeur[codePostal]" id="employeur[codePostal]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[commune]">Commune</label>
            <input name="employeur[commune]" id="employeur[commune]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[telephone]">Téléphone</label>
            <input name="employeur[telephone]" id="employeur[telephone]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[courriel]">Courriel</label>
            <input name="employeur[courriel]" id="employeur[courriel]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[caisseRetraiteComplementaire]">Caisse de retraite complémentaire</label>
            <input name="employeur[caisseRetraiteComplementaire]" id="employeur[caisseRetraiteComplementaire]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[orgPrevoyance]">Organisme de prévoyance (si applicable)</label>
            <input name="employeur[orgPrevoyance]" id="employeur[orgPrevoyance]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[particulierEmployeur]">Particulier-employeur ?</label>
            <input name="employeur[particulierEmployeur]" id="employeur[particulierEmployeur]" type="checkbox" value="1">
        </div>

        <div class="md-3">
            <label for="employeur[urssafParticulierEmployeur]">N° URSSAF du particulier-employeur</label>
            <input name="employeur[urssafParticulierEmployeur]" id="employeur[urssafParticulierEmployeur]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[siret]">N° SIRET</label>
            <input name="employeur[siret]" id="employeur[siret]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[naf]">NAF</label>
            <input name="employeur[naf]" id="employeur[naf]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[effectif]">Effectif total de l'entreprise</label>
            <input name="employeur[effectif]" id="employeur[effectif]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[conventionCollective]">Convention collective applicable</label>
            <input name="employeur[conventionCollective]" id="employeur[conventionCollective]" type="text" class="form-control">
        </div>

        <div class="md-3">
            <label for="employeur[idcc]">Code IDCC de la convention</label>
            <input name="employeur[idcc]" id="employeur[idcc]" type="text" class="form-control">
        </div>

        <button class="btn btn-primary my-3" type="submit">Envoyer</button>
    </form>

@endsection
