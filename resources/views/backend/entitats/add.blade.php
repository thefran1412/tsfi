@extends('layouts.backend')

@section('titol', 'Afegir Entitat')

@section('css')
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/datatables.css') }}">
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/crud.css') }}">
@endsection

@section('content')
     <div class="leftCreate">
          <div class="createHeader">
               <h2>Afegir entitat</h2>
          </div>
          <div class="createBody">
            {!!Form::open(['action' => 'backend\Entitats@store', 'method' => 'post'])!!}
              <div>
                  {!!Form::label('nom', 'Nom: ')!!}
                  {!!Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'Nom de la entitat'])!!}
              </div>
              <div>
                  {!!Form::label('desc', 'Descripció: ')!!}
                  {!!Form::textarea('desc', null, ['class' => 'form-control', 'placeholder' => 'Descripció de la entitat'])!!}
              </div>
              <div>
                  {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
              </div>
          {!!Form::close()!!}
          </div>
     </div>
@endsection
