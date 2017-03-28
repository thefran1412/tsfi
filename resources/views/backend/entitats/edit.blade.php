@extends('layouts.backend')

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Entitats@index') }}">Entitats</a>
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Entitats@edit', ['id' => $entitat->entitat_id]) }}">Editar</a>
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
       {!!Form::model($entitat, ['action' => ['backend\Entitats@update', $entitat->entitat_id], 'method' => 'put',  'id' => 'create', 'files' => true])!!}
        <div class="paper">
          <div>
            {!!Form::label('nomEntitat', 'Nom: ')!!}
            {!!Form::text('nomEntitat', null, ['class' => 'form-control', 'placeholder' => 'Nom de la entitat'])!!}
          </div>
          <div>
            {!!Form::label('esMembre', 'És membre: ')!!}
            {!!Form::checkbox('esMembre', null, ['class' => 'form-control', 'placeholder' => 'Es membre'])!!}
          </div>
          <div class="desc">
            {!!Form::label('descEntitat', 'Descripció: ')!!}
            {!!Form::textArea('descEntitat', null, ['class' => 'form-control', 'placeholder' => 'Descripció de la entitat'])!!}
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
            <input type="file" name="logo" accept="image/*" class="form-control" id="logo">
            {{-- {!!Form::file('logo', null, ['class' => 'form-control', 'placeholder' => 'Logo', 'accept' => 'image/*'])!!} --}}
          </div>
          <div class="preview">
            <div>
              <img src="{{$entitat->logo}}">
            </div>
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
          {!!Form::label('adreca', 'Adreça: ')!!}
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

{{-- @section('css')
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
 --}}