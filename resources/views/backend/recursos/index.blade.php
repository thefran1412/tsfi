@extends('layouts.backend', ['add' => 'link', 'active' => 2])

@section('addUrl', '/admin/recursos/add')

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
            $('#aprovados').DataTable();
            $('#borrados').DataTable();
        } );
    </script>
@endsection

@section('content')
    <div class="wrapper" id="listrecurso">
        <div class="section">
            <div class="sectionHeader">
                <h2>Aprovats</h2>
                <i class="fa fa-angle-down"></i>
            </div>
            <div class="sectionBody">
                <table id="aprovados" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                        <tr>
                            <th>Titol</th>
                            <th>Autor</th>
                            <th>Categoria</th>
                            <th>Entitat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recursos_visibles as $aprovado)
                            @if(isset($aprovado->entity[0]) && $aprovado->entity[0]->deleted == 0 || !isset($aprovado->entity[0]))
                                <tr>
                                    <th><a href="{{action('backend\Recursos@edit', ['id' => $aprovado->recurs_id])}}">{{$aprovado->titolRecurs}}</a></th>
                                    <th>{{$aprovado->creatPer}}</th>
                                    <th>{{isset($aprovado->category[0]) ? $aprovado->category[0]->nomCategoria : 'Sense categoria' }}</th>
                                    <th>{{ isset($aprovado->entity[0]) ? $aprovado->entity[0]->nomEntitat : 'Sense entitat' }}</th>
                                    <th>
                                        {!!Form::open(['url'=>'/admin/recursos/delete/'.$aprovado->recurs_id, 'method' => 'post'])!!}
                                        {!!Form::submit('Borrar', ['class' => 'btn btn-danger'])!!}
                                        {!!Form::close()!!}
                                    </th>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section">
            <div class="sectionHeader">
                <h2>Pendents</h2>
                <i class="fa fa-angle-down rotate"></i>    
            </div>
            <div class="sectionBody" hidden>
                <table id="pendientes" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                        <tr>
                            <th>Titol</th>
                            <th>Autor</th>
                            <th>Autor</th>
                            <th>Aprovar</th>
                            <th>asdasd</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recursos_pendents as $pendent)
                            @if(isset($pendent->entity[0]) && $pendent->entity[0]->deleted == 0 || !isset($pendent->entity[0]))
                                <tr>
                                    <th><a href="{{action('backend\Recursos@edit', ['id' => $pendent->recurs_id])}}">{{$pendent->titolRecurs}}</a></th>
                                    <th>{{$pendent->creatPer}}</th>
                                    <th>{{isset($pendent->category[0]) ? $pendent->category[0]->nomCategoria : 'Sense categoria' }}</th>
                                    <th>{{ isset($pendent->entity[0]) ? $pendent->entity[0]->nomEntitat : 'Sense entitat' }}</th>
                                    <th>
                                        {!!Form::open(['url'=>'/admin/recursos/aprove/'.$pendent->recurs_id, 'method' => 'post'])!!}
                                        {!!Form::submit('Aprovar', ['class' => 'btn btn-primary'])!!}
                                        {!!Form::close()!!}
                                    </th>
                                    <th>
                                        {!!Form::open(['url'=>'/admin/recursos/delete/'.$pendent->recurs_id, 'method' => 'post'])!!}
                                        {!!Form::submit('Borrar', ['class' => 'btn btn-danger'])!!}
                                        {!!Form::close()!!}
                                    </th>
                                </tr>
                            @endif
                           
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section">
            <div class="sectionHeader">
                <h2>Eliminats</h2>
                <i class="fa fa-angle-down rotate"></i>
            </div>
            <div class="sectionBody" hidden>
                <table id="borrados" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                    <tr>
                        <th>Titol</th>
                        <th>Subtitol</th>
                        <th>Autor</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deleted_resources as $deleted)
                        <tr>
                            <th><a href="{{action('backend\Recursos@edit', ['id' => $deleted->recurs_id])}}">{{$deleted->titolRecurs}}</a></th>
                            <th>{{$deleted->subTitol}}</th>
                            <th>{{$deleted->creatPer}}</th>
                            <th>
                                {!!Form::open(['url'=>'/admin/recursos/recover/'.$deleted->recurs_id, 'method' => 'post'])!!}
                                {!!Form::submit('Recuperar', ['class' => 'btn btn-primary'])!!}
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