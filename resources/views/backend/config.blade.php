@extends('layouts.backend', ['active' => 7])

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Backend@config') }}">Configuració</a>
@endsection
@section('css')
    <link href="{{ URL::asset('/css/backend/add.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="paper">
        <div class="paperfull">
            <button class="btn btn-default">
                <h2><a style=" text-decoration: none;" href="{{ action('backend\Usuaris@index') }}">Usuaris</a></h2>
            </button>
        </div>
    </div>
@endsection
