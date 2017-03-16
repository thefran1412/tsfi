@extends('layouts.backend')

@section('css')
    <link href="/js/sumer_note/summernote.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@endsection

@section('titol', 'Afegir Recurs')

@section('content')
    
    <div class="container" style="max-width: 600px;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row justify-content-lg-center text-center">
                    <h2>Crea un Recurso</h2>
                </div>
            </div>
        </div>
        @include('partials.errors')
        <form method="post" action="{{ url('admin/recursos/add') }}" class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-group">
                <label class="control-label col-sm-3" for="autor">Autor:</label>
                <div class="col-sm-9">
                    <input name="creatPer" type="text" class="form-control" id="autor">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="email">Título:</label>
                <div class="col-sm-9">
                    <input name="titolRecurs" type="text" class="form-control" id="title" placeholder="Título" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="email">Subtítulo:</label>
                <div class="col-sm-9">
                    <input name="subTitol" type="text" class="form-control" id="subtitulo" placeholder="Subtítulo">{{ old('subtitol') }}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Descripción detallada:</label>
                <div class="col-sm-9">
                    <textarea name="descDetaill1" type="text" class="form-control input-sm" id="summernote" rows="5">
                        {{ old('descDetaill1') }}
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    {{--Summer Note--}}
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script src="/js/sumer_note/summernote.min.js"></script>
    <script src="/js/sumer_note/summernote-es-ES.js"></script>
    {{--End Summer Note scripts--}}
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,                 // set editor height
                minHeight: 200,             // set minimum height of editor
                maxHeight: 500,             // set maximum height of editor
                focus: true,              // set focus to editable area after initializing summernote
                lang: 'es-ES'
            });
        });
    </script>
@endsection