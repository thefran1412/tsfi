@extends('layouts.backend')

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Entitats@index') }}">Entitats</a>
@endsection

@section('css')
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/datatables.css') }}">
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/crud.css') }}">
@endsection

@section('script')
         <script src="{{ URL::asset('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
             $('#entitats').DataTable();
        });
    </script>
@endsection

@section('content')
     <div>
          <div class="section">
            <div class="sectionHeader">
                <h2>Pendientes</h2>
                <i class="fa fa-angle-down"></i>    
            </div>
            <div class="sectionBody">
                <table id="entitats" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                        <tr>
                            <th>Nom</th>
                            <th>Adreça</th>
                            <th>Web</th>
                            <th>Info</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entitats as $entitat)
                            <tr>
                              <th><a href="{{action('backend\Entitats@edit', ['id' => $entitat->entitat_id])}}"><img class="logo" src="/img/image/{{$entitat->logo}}">{{$entitat->nomEntitat}}</a></th>
                              <th>{{$entitat->adreca}}</th>
                              <th>{{$entitat->link}}</th>
                              <th>{{$entitat->esMembre}}</th>
                              <th>
                                <div class="actions">
                                  <a title="Editar" href="{{action('backend\Entitats@edit', ['id' => $entitat->entitat_id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                  {!!Form::open(['action' => ['backend\Entitats@soft', $entitat->entitat_id], 'method' => 'post'])!!}
                                  {!!Form::submit('Borrar', ['class' => 'btn btn-danger'])!!}
                                  {!!Form::close()!!}
                                </div>
                              </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
     </div>
@endsection
