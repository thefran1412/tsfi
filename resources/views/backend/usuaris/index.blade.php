@extends('layouts.backend')
@section('titol')
    <i class="fa fa-angle-right"></i>
    <a href="{{ action('backend\Backend@config') }}">Configuració</a>
    <i class="fa fa-angle-right"></i>
    <a href="{{ action('backend\Usuaris@index') }}">Usuari</a>
@endsection

@section('css')
    <link href="{{ URL::asset('/css/backend/add.css') }}" rel="stylesheet">
@endsection
@section('content')


    <div class="container">
        {!!Form::model($usuari, ['action' => ['backend\Usuaris@update', $usuari->id], 'method' => 'post', 'class' => 'form-horizontal'])!!}

        <div class="paper">
            <div class="paperfull">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user">Nom de l'usuari</label>
                        <div class="col-md-4">
                            <input id="user" name="user" type="text" placeholder="@if($usuari){{ $usuari->name }} @endif" class="form-control input-md" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="email">E-mail</label>
                        <div class="col-md-4">
                            <input id="email" name="email" type="text" placeholder="@if($usuari){{ $usuari->email }} @endif" class="form-control input-md" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="password">Password</label>
                        <div class="col-md-4">
                            <input id="password" name="password" type="password" placeholder="Escriu un nou password" class="form-control input-md" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="remember">Indici de contrasenya</label>
                        <div class="col-md-4">
                            <input id="remember" name="remember" type="text" placeholder="Escriu un indici de contraseña" class="form-control input-md" required>
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="singlebutton"></label>
                        <div class="col-md-4">
                            <button id="singlebutton" name="singlebutton" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        {!!Form::close()!!}

    </div>





@endsection


@section('script')
    <script src="{{URL::asset('js/jquery-ui.min.js')}}"></script>
@endsection
