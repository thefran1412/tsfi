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
        <div class="headerActions">actions</div>
    </div>
    {{-- HEADER END --}}
    <div class="menu">
        <ul>
            <li><a href="#">Inici</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Recursos</a></li>
            <li><a href="#">Entitats</a></li>
            <li><a href="#">Usuaris</a></li>
            <li><a href="#">Configuració</a></li>
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
