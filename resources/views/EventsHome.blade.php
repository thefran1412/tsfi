<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="fragment" content="!">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
        <meta name="_token" content="{{ csrf_token() }}" />
        <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.png" />
        <link href="https://unpkg.com/animate.css@3.5.1/animate.min.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('css/menu.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome.css') }}" >

        <link rel="stylesheet" type="text/css" href="{{ url('css/recursos.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('css/resource.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('css/multiselect.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('css/send-resource.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('css/search-results.css') }}">

        <title>TSFI</title>



        <script type="text/javascript">
            if(localStorage.length < 2){
                    var url = window.location;
                    window.location.href = url.origin+"/?url="+url.href.substring(22);
                }
        </script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div id="appVue" class="content">

            </div>
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6W8jZVCTHjiEWUf12Gi5oCfehmzPj8mg&libraries=places" async defer></script>
        <script src="{{ URL::asset('/js/app.js') }}" ></script>
        <script src="{{ URL::asset('/js/lightBox.js') }}"></script>

    </body>
</html>