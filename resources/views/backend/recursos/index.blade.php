@extends('layouts.backend')

@section('titol', 'Recursos')
@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="/css/backend/datatables.css">
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendents as $pendent)
                            <tr>
                                <th><a href="{{action('backend\Recursos@edit', ['id' => $pendent->recurs_id])}}">{{$pendent->titolRecurs}}</a></th>
                                <th>{{$pendent->subTitol}}</th>
                                <th>{{$pendent->creatPer}}</th>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resources as $resource)
                            <tr>
                                <th><a href="{{action('backend\Recursos@edit', ['id' => $resource->recurs_id])}}">{{$resource->titolRecurs}}</a></th>
                                <th>{{$resource->subTitol}}</th>
                                <th>{{$resource->creatPer}}</th>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resources as $resource)
                            <tr>
                                <th><a href="{{action('backend\Recursos@edit', ['id' => $resource->recurs_id])}}">{{$resource->titolRecurs}}</a></th>
                                <th>{{$resource->subTitol}}</th>
                                <th>{{$resource->creatPer}}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection