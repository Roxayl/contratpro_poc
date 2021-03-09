@extends('layouts.app')

@section('title')
    Importer depuis un fichier
@endsection

@section('content')

    @parent

    <div class="col-lg-8 offset-lg-2">

        <h2>Importer un fichier</h2>

        <form method="POST" action="{{ route('cerfa.import') }}" enctype="multipart/form-data">
            @csrf

            <input type="file" name="importedFile" class="form-control my-2">

            <br>

            <button type="submit" class="btn btn-primary">Importer le fichier</button>
        </form>

    </div>

@endsection
