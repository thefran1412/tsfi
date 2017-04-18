@extends('layouts.backend')

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Recursos@index') }}">Recursos</a>
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="{{ URL::asset('https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ URL::asset('/css/backend/datatables.css') }}">
@endsection

@section('script')
    <script src="{{ URL::asset('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
             $('#pendientes').DataTable();
             $('#reportados').DataTable();
             $('#aprovados').DataTable();
        } );
    </script>
@endsection

@section('content')
    <div class="wrapper" id="listrecurso">
        <div class="section">
            <div class="sectionHeader">
                <h2>Pendientes</h2>
                <i class="fa fa-angle-down"></i>    
            </div>
            <div class="sectionBody">
                <table id="pendientes" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                        <tr>
                            <th>Titol</th>
                            <th>Subtitol</th>
                            <th>Autor</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recursos_pendents as $pendent)
                            <tr>
                                <th><a href="{{action('backend\Recursos@edit', ['id' => $pendent->recurs_id])}}">{{$pendent->titolRecurs}}</a></th>
                                <th>{{$pendent->subTitol}}</th>
                                <th>{{$pendent->creatPer}}</th>
                                <th>
                                    {!!Form::open(['action' => ['backend\Recursos@destroy', $pendent->entitat_id], 'method' => 'delete'])!!}
                                    {!!Form::submit('Borrar', ['class' => 'btn btn-danger'])!!}
                                    {!!Form::close()!!}
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section">
            <div class="sectionHeader">
                <h2>Reportados</h2>
                <i class="fa fa-angle-down"></i>    
            </div>
            <div class="sectionBody">
                <table id="reportados" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                        <tr>
                            <th>Titol</th>
                            <th>Subtitol</th>
                            <th>Autor</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reported_resources as $reportado)
                            <tr>
                                <th><a href="{{action('backend\Recursos@edit', ['id' => $reportado->recurs_id])}}">{{$reportado->titolRecurs}}</a></th>
                                <th>{{$reportado->subTitol}}</th>
                                <th>{{$reportado->creatPer}}</th>
                                <th>
                                    {!!Form::open(['action' => ['backend\Recursos@destroy', $reportado->entitat_id], 'method' => 'delete'])!!}
                                    {!!Form::submit('Borrar', ['class' => 'btn btn-danger'])!!}
                                    {!!Form::close()!!}
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section">
            <div class="sectionHeader">
                <h2>Aprovados</h2>
                <i class="fa fa-angle-down"></i>    
            </div>
            <div class="sectionBody">
                <table id="aprovados" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                        <tr>
                            <th>Titol</th>
                            <th>Subtitol</th>
                            <th>Autor</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recursos_visibles as $aprovado)
                            <tr>
                                <th><a href="{{action('backend\Recursos@edit', ['id' => $aprovado->recurs_id])}}">{{$aprovado->titolRecurs}}</a></th>
                                <th>{{$aprovado->subTitol}}</th>
                                <th>{{$aprovado->creatPer}}</th>
                                <th>
                                    {!!Form::open(['action' => ['backend\Recursos@destroy', $aprovado->entitat_id], 'method' => 'delete'])!!}
                                    {!!Form::submit('Borrar', ['class' => 'btn btn-danger'])!!}
                                    {!!Form::close()!!}
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="section">
            <div class="sectionHeader">
                <h2>Borrados</h2>
                <i class="fa fa-angle-down"></i>
            </div>
            <div class="sectionBody">
                <table id="aprovados" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                    <tr>
                        <th>Titol</th>
                        <th>Subtitol</th>
                        <th>Autor</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deleted_resources as $deleted)
                        <tr>
                            <th><a href="{{action('backend\Recursos@edit', ['id' => $deleted->recurs_id])}}">{{$deleted->titolRecurs}}</a></th>
                            <th>{{$deleted->subTitol}}</th>
                            <th>{{$deleted->creatPer}}</th>
                            <th>
                                {!!Form::open(['action' => ['backend\Recursos@destroy', $deleted->entitat_id], 'method' => 'delete'])!!}
                                {!!Form::submit('Borrar', ['class' => 'btn btn-danger'])!!}
                                {!!Form::close()!!}
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection