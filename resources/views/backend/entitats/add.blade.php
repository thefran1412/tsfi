@extends('layouts.backend')

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Entitats@index') }}">Entitats</a>
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Entitats@add') }}">Afegir</a>
@endsection

@section('css')
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/datatables.css') }}">
     {{-- <link rel="stylesheet" href="{{ URL::asset('/css/backend/crud.css') }}"> --}}
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/add.css') }}">
@endsection

@section('script')
<script src="{{ URL::asset('/js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('/js/createEntity.js') }}"></script>
  <script src="{{ URL::asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyC6W8jZVCTHjiEWUf12Gi5oCfehmzPj8mg&libraries=places&callback=initMap') }}" async defer></script>
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
                    {!!Form::label('esMembre', 'És membre: ')!!}
                    {!!Form::checkbox('esMembre', null, ['class' => 'form-control', 'placeholder' => 'Es membre'])!!}
                  </div>
                  <div>
                    {!!Form::label('telf1', 'Telèfon 1: ')!!}
                    {!!Form::number('telf1', null, ['class' => 'form-control', 'placeholder' => 'Telefon 1 de la entitat'])!!}
                  </div>
                  <div>
                    {!!Form::label('telf2', 'Telèfon 2: ')!!}
                    {!!Form::number('telf2', null, ['class' => 'form-control', 'placeholder' => 'Telefon 2 de la entitat'])!!}
                  </div>
                </div>
                <div class="paper">
                  <div class="upload">
                    {!!Form::label('logo', 'Logo: ')!!}
                    <input type="file" name="logo" accept="image/*" class="form-control">
                    {{-- {!!Form::file('logo', null, ['class' => 'form-control', 'placeholder' => 'Logo', 'accept' => 'image/*'])!!} --}}
                  </div>

              </div>
              <div class="paper">
                  <div>
                    {!!Form::label('link', 'Enllaç pàgina web: ')!!}
                    {!!Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'Enllaç a la pàgina web'])!!}
                  </div>
                  <div>
                    {!!Form::label('facebook', 'Facebook: ')!!}
                    {!!Form::text('facebook', null, ['class' => 'form-control', 'placeholder' => 'Url Facebook'])!!}
                  </div>
                  <div>
                    {!!Form::label('twitter', 'Twitter: ')!!}
                    {!!Form::text('twitter', null, ['class' => 'form-control', 'placeholder' => 'Url Twitter'])!!}
                  </div>
                  <div>
                    {!!Form::label('instagram', 'Instagram: ')!!}
                    {!!Form::text('instagram', null, ['class' => 'form-control', 'placeholder' => 'Url Instagram'])!!}
                  </div>
                </div>

              </div>
              <div class="paper">
                  {!!Form::label('desc', 'Adreça: ')!!}
                  {!!Form::text('adreca', null, ['class' => 'form-control location', 'placeholder' => 'Adreça de la entitat', 'id' => 'pac-input'])!!}

              <div class="map"><div id="map"></div></div>
              <div id="infowindow-content">
                <span id="place-name" class="title"></span>
                <br>Place ID <span id="place-id"></span><br>
                <span id="place-address"></span>
              </div>
              <div class="air">
                  {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
              </div>
                    {!!Form::close()!!}
               </div>
@endsection
