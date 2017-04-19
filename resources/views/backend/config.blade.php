@extends('layouts.backend', ['active' => 7])

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Backend@config') }}">Configuració</a>
@endsection

@section('content')
     <h2>Usuaris</h2>
@endsection
