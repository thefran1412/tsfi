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
                  {!!Form::label('desc', 'Telèfon 1: ')!!}
                  {!!Form::number('telf1', null, ['class' => 'form-control', 'placeholder' => 'Telefon de la entitat 1'])!!}

                  {!!Form::label('desc', 'Telèfon 2: ')!!}
                  {!!Form::number('telf2', null, ['class' => 'form-control', 'placeholder' => 'Telefon de la entitat 2'])!!}
                  {!!Form::label('desc', 'Enllaç pàgina web: ')!!}
                  {!!Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'Enllaç a la pàgina web'])!!}

                  {!!Form::label('desc', 'Logo: ')!!}
                  {!!Form::file('logo', null, ['class' => 'form-control', 'placeholder' => 'Logo'])!!}

                  {!!Form::label('desc', 'És membre: ')!!}
                  {!!Form::checkbox('esMembre', null, ['class' => 'form-control', 'placeholder' => 'Es membre'])!!}
              </div>
              <div class="paper">
                  {!!Form::label('desc', 'Adreça: ')!!}
                  {!!Form::text('adreca', null, ['class' => 'form-control', 'placeholder' => 'Adreça de la entitat'])!!}

                  localització
              </div>
              <div class="paper">
                  {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
              </div>
          {!!Form::close()!!}
     </div>
@endsection
