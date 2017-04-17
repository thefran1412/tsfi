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
  <script src="{{ URL::asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyC6W8jZVCTHjiEWUf12Gi5oCfehmzPj8mg&libraries=places&callback=before') }}" async defer></script>
  <script src="{{ URL::asset('/js/map_back.js') }}"></script>

  <script type="text/javascript">
  function before() {
    @if ($entitat->idLocalitzacio != null)
      initMap({{$location->latitud}}, {{$location->longitud}}, '{{$entitat->adreca}}');
    @else
      initMap();
    @endif
  }

  </script>
@endsection

@section('content')
    <div class="create">
        {!!Form::model($entitat, ['action' => ['backend\Entitats@update', $entitat->entitat_id], 'method' => 'put',  'id' => 'create', 'files' => true])!!}
        <div class="paper">
          <div class="paperdiv">
            {!!Form::label('nomEntitat', 'Nom: ')!!}
            {!!Form::text('nomEntitat', null, ['class' => 'form-control', 'placeholder' => 'Nom de la entitat'])!!}
          </div>
          <div class="paperdiv">
            {!!Form::label('esMembre', 'És membre: ')!!}
            
            @if($entitat->esMembre)
              <?php $checked = true; ?> 
            @else
              <?php $checked = false; ?>
            @endif
            
            {!!Form::checkbox('esMembre', 'true', $checked)!!}
          </div>
          <div class="desc paperdiv">
            {!!Form::label('descEntitat', 'Descripció: ')!!}
            {!!Form::textArea('descEntitat', null, ['class' => 'form-control', 'placeholder' => 'Descripció de la entitat'])!!}
          </div>
          <div class="paperdiv">
            {!!Form::label('telf1', 'Telèfon 1: ')!!}
            {!!Form::number('telf1', null, ['class' => 'form-control', 'placeholder' => 'Telefon 1 de la entitat'])!!}
          </div>
          <div class="paperdiv">
            {!!Form::label('telf2', 'Telèfon 2: ')!!}
            {!!Form::number('telf2', null, ['class' => 'form-control', 'placeholder' => 'Telefon 2 de la entitat'])!!}
          </div>
        </div>
        <div class="paper">
          <div class="paperdiv upload">
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
          <div class="paperdiv">
            {!!Form::label('link', 'Enllaç pàgina web: ')!!}
            {!!Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'Enllaç a la pàgina web'])!!}
          </div>
          <div class="paperdiv">
            {!!Form::label('facebook', 'Facebook: ')!!}
            {!!Form::text('facebook', null, ['class' => 'form-control', 'placeholder' => 'Url Facebook'])!!}
          </div>
          <div class="paperdiv">
            {!!Form::label('twitter', 'Twitter: ')!!}
            {!!Form::text('twitter', null, ['class' => 'form-control', 'placeholder' => 'Url Twitter'])!!}
          </div>
          <div class="paperdiv">
            {!!Form::label('instagram', 'Instagram: ')!!}
            {!!Form::text('instagram', null, ['class' => 'form-control', 'placeholder' => 'Url Instagram'])!!}
          </div>
        </div>

        </div>
        <div class="paper">
          {!!Form::label('adreca', 'Adreça: ')!!}
          {!!Form::text('adreca', null, ['class' => 'form-control location', 'placeholder' => 'Adreça de la entitat', 'id' => 'pac-input'])!!}
          {!!Form::hidden('lat', null, ['class' => 'form-control', 'id' => 'lat'])!!}
          {!!Form::hidden('lng', null, ['class' => 'form-control', 'id' => 'lng'])!!}

        <div class="map"><div id="map"></div></div>
        <div id="infowindow-content">
          <span id="place-name" class="title">{{$entitat->adreca}}</span>
          <span id="place-address"></span>
        </div>
        <div class="air">
          {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
        </div>
        {!!Form::close()!!}
        </div>
@endsection