@extends('layouts.backend', ['active' => 3])

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Categories@index') }}">Categories</a>
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Categories@edit', ['id' => $categoria->categoria_id]) }}">Editar</a>
@endsection

@section('css')
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/datatables.css') }}">
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/crud.css') }}">
@endsection

@section('content')
     <div class="leftCreate">
          <div class="createHeader">
               <h2>Editar</h2>
          </div>
          <div class="createBody">
            {!!Form::model($categoria, ['action' => ['backend\Categories@update', $categoria->categoria_id], 'method' => 'put'])!!}
              <div>
                  {!!Form::label('nomCategoria', 'Nom: ')!!}
                  {!!Form::text('nomCategoria', null, ['class' => 'form-control', 'placeholder' => 'Nom de la categoria'])!!}
              </div>
              <div>
                  {!!Form::label('descCategoria', 'Descripció: ')!!}
                  {!!Form::textarea('descCategoria', null, ['class' => 'form-control', 'placeholder' => 'Descripció de la categoria'])!!}
              </div>
              <div>
                  {!!Form::label('codiCategoria', 'Codi: ')!!}
                  {!!Form::text('codiCategoria', null, ['class' => 'form-control', 'placeholder' => 'Codi de la categoria'])!!}
              </div>
              <div>
                  {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
              </div>
          {!!Form::close()!!}
          </div>
     </div>
@endsection
