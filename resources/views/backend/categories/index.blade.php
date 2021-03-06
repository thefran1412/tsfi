@extends('layouts.backend', ['add' => 'true', 'active' => 3])

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Categories@index') }}">Categories</a>
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
             $('#categories').DataTable();
        } );
    </script>
@endsection

@section('add')
  <div class="section">
    <div class="sectionHeader">
        <h2>Afegir Categoria</h2>
        <i class="fa fa-angle-down"></i>    
    </div>
    <div class="sectionBody">
      {!!Form::open(['action' => 'backend\Categories@store', 'method' => 'post'])!!}
        <div class="mar">
            {!!Form::label('nomCategoria', 'Nom: ')!!}
            {!!Form::text('nomCategoria', null, ['class' => 'form-control', 'placeholder' => 'Nom de la categoria'])!!}
        </div>
        <div class="mar">
            {!!Form::label('descCategoria', 'Descripció: ')!!}
            {!!Form::textarea('descCategoria', null, ['class' => 'form-control', 'placeholder' => 'Descripció de la categoria'])!!}
        </div>
        <div class="mar">
            {!!Form::label('codiCategoria', 'Codi: ')!!}
            {!!Form::text('codiCategoria', null, ['class' => 'form-control', 'placeholder' => 'Codi de la categoria'])!!}
        </div>
        <div class="mar">
            {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
        </div>
    {!!Form::close()!!}
    </div>
   </div>
@endsection

@section('content')
     <div class="rightTable">
          <div class="section">
            <div class="sectionHeader">
                <h2>Categories</h2>
                <i class="fa fa-angle-down"></i>    
            </div>
            <div class="sectionBody">
                <table id="categories" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                        <tr>
                            <th>Nom</th>
                            <th>Descripció</th>
                            <th>Codi</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $categoria)
                            <tr>
                              <th><a href="{{action('backend\Categories@edit', ['id' => $categoria->categoria_id])}}">{{$categoria->nomCategoria}}</a></th>
                              <th>{{$categoria->descCategoria}}</th>
                              <th>{{$categoria->codiCategoria}}</th>
                              <th>
                                <div class="actions">
                                  <a title="Editar" href="{{action('backend\Categories@edit', ['id' => $categoria->categoria_id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                  {!!Form::open(['action' => ['backend\Categories@destroy', $categoria->categoria_id], 'method' => 'delete', 'id' => 'dle'.$categoria->categoria_id, 'class' => $categoria->categoria_id])!!}
                                  {!!Form::submit('Borrar', ['class' => 'btn btn-danger del'])!!}
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
