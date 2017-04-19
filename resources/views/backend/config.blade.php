@extends('layouts.backend')

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Backend@config') }}">Configuració</a>
@endsection

@section('content')
     <h2><a href="{{ action('backend\Usuaris@index') }}">Usuaris</a></h2>
@endsection
