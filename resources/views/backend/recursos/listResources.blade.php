@extends('layouts.backend')

@section('content')
    <style type="text/css">
        p {text-indent: 50px;}
        .alert {width:60%;}
        #listrecurso .table{max-width: 500px;}
        #listrecurso .table th {text-align: center;color :red;}
        td img{text-align: center;}
    </style>
    <h2>Recurso</h2>
    <div class="content" id="listrecurso">
                @if($recursos->isEmpty())

                <div class="alert alert-warning">
                    <strong>Atención!</strong> No se ha encontrado ningún recurso.
                </div>
                @else
                <table class="table table-bordered table-responsive">
                @foreach($recursos as $recurso)
                    @if($recurso->relevancia > 3)
                            <thead class="thead-inverse">
                            <tr>
                                <th  scope="row" colspan="3">{!! strtoupper($recurso->titol)!!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="tg-baqh" colspan="3">{{$recurso->subTitol}}</td>
                            </tr>
                            <tr>
                                <td class="tg-baqh" colspan="3">{{$recurso->descDetaill1}}</td>
                            </tr>
                            <tr>
                                <td class="tg-baqh" colspan="3"  align="center"><img src="{{$recurso->fotoResum}}" width="250px" align="middle"></td>
                            </tr>
                            <tr>
                                <td class="tg-yw4l">{{$recurso->creatPer}}</td>
                                <td class="tg-yw4l">{{$recurso->created_at}}</td>
                                <td class="tg-yw4l">{{$recurso->relevancia}}</td>
                            </tr>
                            </tbody>

                    @endif
                @endforeach
        </table>
            {!! $recursos->render() !!}
    </div>
@endif
@endsection