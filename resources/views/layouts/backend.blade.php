<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/backend.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    {{-- HEADER START --}}
    <div class="header">
        <div class="headerIcon">T.S.F.I</div>
        <div class="headerSearch">
        <input type="text" name="search">
        </div>
        <div class="headerActions">
            <a href="#" class="noti">Notificacions</a>
            <a href="{{url('/')}}">Frontend</a>
            {{-- LOGOUT --}}
            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    {{-- HEADER END --}}
    <div class="menu">
        <ul>
            <li><a href="{{  action('backend\Backend@index') }}">Inici</a></li>
            <li><a href="{{  action('backend\Recursos@index') }}">Recursos</a></li>
            <li><a href="{{  action('backend\Recursos@add') }}">---Add</a></li>
            <li><a href="{{  action('backend\Categories@index') }}">---Categories</a></li>
            <li><a href="{{  action('backend\Tags@index') }}">---Tags</a></li>
            <li><a href="{{  action('backend\Entitats@index') }}">Entitats</a></li>
            <li><a href="{{  action('backend\Entitats@add') }}">---Add</a></li>
            <li><a href="{{  action('backend\Usuaris@index') }}">Usuaris</a></li>
            <li><a href="{{  action('backend\Usuaris@add') }}">---Add</a></li>
            <li><a href="{{  action('backend\Analytics@index') }}">Analytics</a></li>
            <li><a href="{{  action('backend\Backend@config') }}">Configuració</a></li>
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
