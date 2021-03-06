@extends('layouts.app')

@section('title')
    Créer un contrat de professionnalisation
@endsection

@section('content')

    @parent

    <form method="POST" action="{{ route('contrat.create') }}">
        @csrf

        <div class="mb-3">
            <label for="employeur[denomination]">Nom et prénom ou dénomination de l'employeur</label>
            <input name="employeur[denomination]" id="employeur[denomination]" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label for="employeur[noAdresse]">N° Adresse</label>
            <input name="employeur[noAdresse]" id="employeur[noAdresse]" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label for="employeur[voieAdresse]">Voie adresse</label>
            <input name="employeur[voieAdresse]" id="employeur[voieAdresse]" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label for="employeur[complementAdresse]">Complément adresse</label>
            <input name="employeur[complementAdresse]" id="employeur[complementAdresse]" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label for="employeur[codePostal]">Code postal</label>
            <input name="employeur[codePostal]" id="employeur[codePostal]" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label for="employeur[commune]">Commune</label>
            <input name="employeur[commune]" id="employeur[commune]" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label for="employeur[telephone]">Téléphone</label>
            <input name="employeur[telephone]" id="employeur[telephone]" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label for="employeur[courriel]">Courriel</label>
            <input name="employeur[courriel]" id="employeur[courriel]" type="text" class="form-control">
        </div>

        <button class="btn btn-primary" type="submit">Envoyer</button>
    </form>

@endsection
