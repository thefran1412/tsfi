@extends('tsfi - copia.resources.views.base')

@section('content')
    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg-baqh{text-align:center;vertical-align:top}
        .tg-yw4l{vertical-align:top}
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
                                <td class="tg-yw4l">{{$recurso->creatPer}}</td>
                                <td class="tg-yw4l">{{$recurso->created_at}}</td>
                                <td class="tg-yw4l">{{$recurso->relevancia}}</td>
                            </tr>
                            </tbody>

                    @endif
                @endforeach
        </table>
    </div>
{!! $recursos->render() !!}
@endif
@endsection