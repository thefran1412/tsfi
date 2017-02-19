<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
        <meta name="_token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" type="text/css" href="css/app.css">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <a onclick="saveTypeLocalStorage('student')" href="{{ url('/students/home/') }}">Students</a>
            <a onclick="saveTypeLocalStorage('teacher')" href="{{ url('/teachers/home/') }}">Teachers</a>
            <!-- <div id="app" class="content">
                
            </div> -->
        </div>
        <!--<script src="/js/app.js"></script>-->
    </body>
    <script>

        whatPage();

        function whatPage(){

            if(localStorage.length === 1){

                var typeUser = localStorage.getItem("typeUser");
                
                if(typeUser === 'student'){
                    location.pathname = '/students/home/';
                }else{
                    location.pathname = '/teachers/home/';
                }
            }

        }

        function saveTypeLocalStorage(typeUser){

            if (window.localStorage) {
                localStorage.setItem('typeUser', typeUser);
            } else {
              throw new Error('Tu Browser no soporta LocalStorage!');
            }
        }

    </script>
</html>
