<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Styles -->
    <link href="{{ URL::asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/backend.css') }}" rel="stylesheet">
    @yield('css')

</head>
<body>
    {{-- HEADER START --}}
    <div class="header">
        <div class="headerIcon">T.S.F.I</div>
{{--         <div class="headerSearch">
        </div> --}}
        <div class="headerActions">
            <a title="Veure Pàgina" href="{{url('/')}}" class="home"><img src="/img/home.png"></a>
            <a title="Notificacions" href="#" class="noti"><img alt="Notificacions" src="/img/noti.png"></a>
            {{-- LOGOUT --}}
            <a title="Més opcions" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">admin<img src="/img/down.png" class="dropdown"></a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    {{-- HEADER END --}}
    <div class="menu">
        <ul class="nav navbar-nav">
            <li><a href="{{  action('backend\Backend@index') }}"><i class="fa fa-home"></i>Inici</a></li>
            <li><a href="{{  action('backend\Recursos@index') }}"><i class="fa fa-file-text"></i>Recursos</a></li>
            {{-- <li><a href="{{  action('backend\Recursos@add') }}">---Add</a></li> --}}
            <li><a href="{{  action('backend\Categories@index') }}"><i class="fa fa-archive"></i>Categories</a></li>
            <li><a href="{{  action('backend\Tags@index') }}"><i class="fa fa-tag"></i>Tags</a></li>
            <li><a href="{{  action('backend\Entitats@index') }}"><i class="fa fa-building"></i>Entitats</a></li>
            {{-- <li><a href="{{  action('backend\Entitats@add') }}">---Add</a></li> --}}
            {{-- <li><a href="{{  action('backend\Usuaris@index') }}"><i class="fa fa-user"></i>Usuaris</a></li> --}}
            {{-- <li><a href="{{  action('backend\Usuaris@add') }}">---Add</a></li> --}}
            <li><a href="{{  action('backend\Analytics@index') }}"><i class="fa fa-bar-chart"></i>Analytics</a></li>
            <li><a href="{{  action('backend\Backend@config') }}"><i class="fa fa-cog"></i>Configuració</a></li>
        </ul>
    </div>
    <div class="content">
    <div class="page-header">
        <h1>@yield('titol')</h1>
    </div>
        @yield('content')
    </div>
</body>

<!-- Scripts -->
{{-- http://g3s2aw.sdslab.cat/projects/public_tsfi2 --}}
 <script src="{{ URL::asset('/js/jquery.min.js') }}"></script>
 <script type="{{ URL::asset('/js/bootstrap.min.js') }}"></script>
 <script src="{{ URL::asset('/js/backend.js') }}"></script>
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
@yield('script')
</html>
