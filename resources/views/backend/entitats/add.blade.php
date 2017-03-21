@extends('layouts.backend')

@section('titol', 'Afegir Entitat')

@section('css')
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/datatables.css') }}">
     {{-- <link rel="stylesheet" href="{{ URL::asset('/css/backend/crud.css') }}"> --}}
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/add.css') }}">
@endsection

@section('content')
     <div class="create">
            {!!Form::open(['action' => 'backend\Entitats@store', 'method' => 'post'])!!}
              <div class="paper">
                  {!!Form::label('nom', 'Nom: ')!!}
                  {!!Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'Nom de la entitat'])!!}
              </div>
              <div class="paper">
                  {!!Form::label('desc', 'Descripció: ')!!}
                  {!!Form::textarea('desc', null, ['class' => 'form-control', 'placeholder' => 'Descripció de la entitat'])!!}
              </div>
              <div class="paper">
                  {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
              </div>
          {!!Form::close()!!}
     </div>
@endsection
