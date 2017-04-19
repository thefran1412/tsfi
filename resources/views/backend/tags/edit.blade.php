@extends('layouts.backend', ['active' => 4])

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Tags@index') }}">Tags</a>
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Tags@edit', ['id' => $tag->tags_id]) }}">Editar</a>
@endsection

@section('css')
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/datatables.css') }}">
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/crud.css') }}">
@endsection

@section('content')
     <div class="section">
            <div class="sectionHeader">
                <h2>Editar Tag</h2>
                <i class="fa fa-angle-down"></i>    
            </div>
            <div class="sectionBody">
                {!!Form::model($tag, ['action' => ['backend\Tags@update', $tag->tags_id], 'method' => 'put'])!!}
              <div>
                  {!!Form::label('nomTags', 'Nom: ')!!}
                  {!!Form::text('nomTags', null, ['class' => 'form-control', 'placeholder' => 'Nom del tag'])!!}
              </div>
              <div class="mar">
                  {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
              </div>
          {!!Form::close()!!}
            </div>
     </div>
@endsection
