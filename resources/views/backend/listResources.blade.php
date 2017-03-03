@extends('base')

@section('content')
    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg-baqh{text-align:center;vertical-align:top}
        .tg-yw4l{vertical-align:top}
    </style>
    <h2>Recurso</h2>
    <div class="content">
        <table class=".table-striped">
        @foreach($recursos as $recurso)
            @if($recurso->relevancia > 1)

                    <tr>
                        <th class="tg-baqh" colspan="3"><h1>{{ $recurso->titol }}</h1></th>
                    </tr>
                    <tr>
                        <td class="tg-baqh" colspan="3"><h3>{{ $recurso->subTitol }}</h3></td>
                    </tr>
                    <tr>
                        <td class="tg-baqh" colspan="3"><p> {{ $recurso->descDetaill1 }}</p></td>
                    </tr>
                    <tr>
                        <td class="tg-yw4l">{{ $recurso->creatPer }}</td>
                        <td class="tg-yw4l">{{ $recurso->created_at}}</td>
                        <td class="tg-yw4l">{{ $recurso->relevancia }}</td>
                    </tr>
        @endif
        @endforeach
        </table>
    </div>





    {!! $recursos->render() !!}
@endsection