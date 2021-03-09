@extends('layouts.app')

@section('title')
    Importer depuis un fichier
@endsection

@section('content')

    @parent

    <h2>Importer un fichier .csv</h2>

    <form method="POST" action="{{ route('cerfa.import') }}" enctype="multipart/form-data">
        @csrf

        <input type="file" name="importedFile" accept="text/csv" class="form-control my-2">

        <br>

        <button type="submit" class="btn btn-primary">Importer le fichier</button>
    </form>

@endsection
