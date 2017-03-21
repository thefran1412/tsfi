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
                  <div>
                    {!!Form::label('nom', 'Nom: ')!!}
                    {!!Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'Nom de la entitat'])!!}
                  </div>
                  <div>
                    {!!Form::label('link', 'Enllaç pàgina web: ')!!}
                    {!!Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'Enllaç a la pàgina web'])!!}
                  </div>
                  <div>
                    {!!Form::label('desc', 'És membre: ')!!}
                    {!!Form::checkbox('esMembre', null, ['class' => 'form-control', 'placeholder' => 'Es membre'])!!}
                  </div>
              </div>
              <div class="paper">
                  <div>
                    {!!Form::label('desc', 'Telèfon 1: ')!!}
                    {!!Form::number('telf1', null, ['class' => 'form-control', 'placeholder' => 'Telefon de la entitat 1'])!!}
                  </div>
                  <div>
                    {!!Form::label('desc', 'Telèfon 2: ')!!}
                    {!!Form::number('telf2', null, ['class' => 'form-control', 'placeholder' => 'Telefon de la entitat 2'])!!}
                  </div>
                </div>
                <div class="paper">
                  <div class="upload">
                    {!!Form::label('desc', 'Logo: ')!!}
                    {!!Form::file('logo', null, ['class' => 'form-control', 'placeholder' => 'Logo'])!!}
                  </div>

              </div>
              <div class="paper">
                  {!!Form::label('desc', 'Adreça: ')!!}
                  {!!Form::text('adreca', null, ['class' => 'form-control location', 'placeholder' => 'Adreça de la entitat'])!!}

                  <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJhwzf5aSipBIRVKZl89WuF0c&key=AIzaSyC4_7SNfNuNIVeW8vwguS8QheTX0v3Bll0" allowfullscreen></iframe>
              </div>
              <div class="air">
                  {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
              </div>
          {!!Form::close()!!}
     </div>
@endsection
