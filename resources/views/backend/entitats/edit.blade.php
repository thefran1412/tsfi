@extends('layouts.backend')

@section('titol', 'Editar categories')

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
            {!!Form::model($entitat, ['action' => ['backend\Entitats@update', $entitat->entitat_id], 'method' => 'put'])!!}
              <div>
                  {!!Form::label('nomEntitat', 'Nom: ')!!}
                  {!!Form::text('nomEntitat', null, ['class' => 'form-control', 'placeholder' => 'Nom de la entitat'])!!}
              </div>
              <div>
                  {!!Form::label('adreca', 'Descripció: ')!!}
                  {!!Form::text('adreca', null, ['class' => 'form-control', 'placeholder' => 'Descripció del entitat'])!!}
              </div>
              <div>
                  {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
              </div>
          {!!Form::close()!!}
          </div>
     </div>
@endsection
