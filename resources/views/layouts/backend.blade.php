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
        {{-- TITLE --}}
        <div class="headerTitle">
            <span>TSFI</span>
        </div>

        {{-- ACTIONS --}}
        <div class="headerActions">
            {{-- FRONTEND --}}
            <div class="globe">
                <a title="Veure Pàgina" target="_blank" href="{{url('/')}}" class="home"><i class="fa fa-globe"></i></a>
            </div>
            {{-- LOGOUT --}}
            <div class="logout">
                <a title="Tancar Sessió" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i></a>
            </div>
            
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            {{-- NOTIFICATIONS --}}
            {{-- <a title="Notificacions" href="#" class="noti"><i class="fa fa-bell-o"></i><!-- <img alt="Notificacions" src="/img/noti.png"> --></a> --}}
            {{-- <a title="Més opcions" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">admin<i class="fa fa-angle-down dropdown"></i><!-- <img src="/img/down.png" > --></a> --}}
        </div>

    </div>
    {{-- HEADER END --}}
    <div class="menu">
        {{-- ICON --}}
        {{-- <div class="menuIcon">T.S.F.I</div> --}}
        <ul>
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
    
    <div class="subHeader">
        {{-- ROUTE --}}
        <div class="headerRoute">
            <h2><a href="{{ action('backend\Backend@index') }}"><i class="fa fa-home"></i></a>@yield('titol')</h2>
        </div>
        <div class="subActions">
            <i class="fa fa-plus"></i>
            <span>Afegir</span>
        </div>
    </div>

    <div class="content">
      @if(count($errors) > 0)
        <div class="row">
            @foreach($errors->all() as $error)
              <div class="alert alert-danger fade in alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                <strong>Error!</strong> {{ $error }}
              </div>
            @endforeach
        </div>
    @endif
    
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
<script type="text/javascript">
    $( window ).scroll(function() {
        if ($(window).scrollTop() > 0) {
            $('.subHeader').addClass('bg');
            $('.headerRoute, .subActions').addClass('pad');
            $('.subActions').addClass('down');
        }
        else{
            $('.subHeader').removeClass('bg');
            $('.headerRoute, .subActions').removeClass('pad');
            $('.subActions').removeClass('down');
        }
    });
</script>
@yield('script')
</html>
