@extends('layouts.backend')

@section('content')

    <div class="content" id="listrecurso">
        <h2>Pendientes</h2>
        <table id="pendientes" class="table table-bordered table-responsive">
            <thead >
                <tr>
                    <th>Titol</th>
                    <th>Subtitol</th>
                    <th>Descripció</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendents as $pendent)
                    <tr>
                        <th><a href="{{action('backend\Recursos@edit', ['id' => $pendent->id])}}">{{$pendent->titol}}</a></th>
                        <th>{{$pendent->subTitol}}</th>
                        <th>{{$pendent->descDetaill1}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h2>Reportados</h2>
        <table id="reportados" class="table table-bordered table-responsive">
            <thead >
                <tr>
                    <th>Titol</th>
                    <th>Subtitol</th>
                    <th>Descripció</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resources as $resource)
                    <tr>
                        <th>{{$resource->titol}}</th>
                        <th>{{$resource->subTitol}}</th>
                        <th>{{$resource->descDetaill1}}</th>
                        <th>Hola</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h2>Aprovados</h2>
        <table id="aprovados" class="table table-bordered table-responsive">
            <thead >
                <tr>
                    <th>Titol</th>
                    <th>Subtitol</th>
                    <th>Descripció</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resources as $resource)
                    <tr>
                        <th>{{$resource->titol}}</th>
                        <th>{{$resource->subTitol}}</th>
                        <th>{{$resource->descDetaill1}}</th>
                        <th>Hola</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection