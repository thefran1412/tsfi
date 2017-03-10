@extends('layouts.backend')

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
        <table id="myTable" class="table table-bordered table-responsive">
            <thead >
                <tr>
                    <th>Titol</th>
                    <th>Subtitol</th>
                    <th>Descripció</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection