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

        <button class="btn btn-primary" type="submit">Envoyer</button>
    </form>

@endsection
