@extends('layouts.backend')

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
     <div class="leftCreate">
          <div class="createHeader">
               <h2>Editar</h2>
          </div>
          <div class="createBody">
            {!!Form::model($tag, ['action' => ['backend\Tags@update', $tag->tags_id], 'method' => 'put'])!!}
              <div>
                  {!!Form::label('nomTags', 'Nom: ')!!}
                  {!!Form::text('nomTags', null, ['class' => 'form-control', 'placeholder' => 'Nom del tag'])!!}
              </div>
              {{-- <div>
                  {!!Form::label('descTag', 'Descripció: ')!!}
                  {!!Form::textarea('descTag', null, ['class' => 'form-control', 'placeholder' => 'Descripció del tag'])!!}
              </div> --}}
              <div>
                  {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
              </div>
          {!!Form::close()!!}
          </div>
     </div>
@endsection
