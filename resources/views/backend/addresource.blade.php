@extends('base')

@section('content')
    <div class="container" style="max-width: 600px;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row justify-content-lg-center text-center">
                    <h2>Crea un Recurso</h2>
                </div>
            </div>
        </div>

        <form class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-group">
                <label class="control-label col-sm-3" for="autor">Autor:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="autor">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="email">Título:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" placeholder="Título">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="email">Subtítulo:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="subtitulo" placeholder="Subtítulo">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Descripción detallada:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control input-sm" id="pwd">
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