@extends('layouts.app')

@section('title')
    Créer un contrat de professionnalisation
@endsection

@section('content')

    @parent

    <h2>Remplir un contrat de professionnalisation</h2>

    <form method="POST" action="{{ route('cerfa.generate-pdf') }}">
        @csrf

        {!! $content !!}

        <button type="submit" class="btn btn-primary">Envoyer !</button>
    </form>

@endsection
