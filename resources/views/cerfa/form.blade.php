@extends('layouts.app')

@section('title')
    Créer un contrat de professionnalisation
@endsection

@section('content')

    @parent

    <h2>Remplir un contrat de professionnalisation</h2>

    <button class="btn btn-outline-primary" id="pre-remplir">Pré-remplir les données...</button>

    <form method="POST" action="{{ route('cerfa.generate-pdf') }}">
        @csrf

        {!! $content !!}

        <button type="submit" class="btn btn-primary">Envoyer !</button>
    </form>

    <script>
        (function($, document, window, undefined) {
            $('#pre-remplir').on('click', function() {
                $.ajax({
                    url: "{{ url('export/json') }}",
                    method: 'GET',
                    dataType: "json",
                    success: function(json) {
                        var fieldName, fieldType,
                            $input, $inputs, $select, $selects, index;
                        $inputs = $('input');
                        $inputs.each(function(id, input) {
                            $input = $(input);
                            fieldName = $input.prop('name');
                            fieldType = $input.prop('type');
                            if(json.hasOwnProperty(fieldName)) {
                                switch(fieldType) {
                                    case 'text':
                                        $input.val(json[fieldName]);
                                        break;
                                    case 'radio':
                                        $input.parent().find('input:first').attr('checked', true);
                                        break;
                                }
                            }
                        });

                        $selects = $('select');
                        $selects.each(function(id, select) {
                            $select = $(select);
                            fieldName = $select.prop('name');
                            if(json.hasOwnProperty(fieldName)) {
                                index = Math.floor(Math.random() * $($select).find('option').length) + 1;
                                if(index === 0) index = 1;
                                console.log($select, index);
                                $select.find('option:nth-child(' + index + ')').prop("selected", true);
                            }
                        });
                    }
                });
            });
        })(jQuery, document, window);
    </script>

@endsection
