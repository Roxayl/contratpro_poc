@extends('layouts.app')

@section('title')
    Créer un contrat de professionnalisation
@endsection

@section('content')

    @parent

    <form method="POST" action="{{ route('cerfa.generate-pdf') }}" class="col-lg-8 offset-lg-2">
        @csrf

        {!! $content !!}

        <button type="submit" class="btn btn-primary">Envoyer !</button>
    </form>

@endsection
