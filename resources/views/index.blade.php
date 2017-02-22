<script type="text/javascript">
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
</script>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
        <meta name="_token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" type="text/css" href="css/app.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="home-container">
            <a onclick="saveTypeLocalStorage('student')" href="{{ url('/students/home/') }}">
                <div class="student">
                    <h1>T.S.</h1>
                    <h2>Taula Sectorial</h2>
                     <!-- <div>
                        <img src="img/family.png">
                    </div>  -->

                    <div>
                        <span>Estudiants</span>
                        <span>i</span>
                        <span>Pares</span>
                    </div>
                </div>
            </a>
            <a onclick="saveTypeLocalStorage('teacher')" href="{{ url('/teachers/home/') }}">
                <div class="teacher">
                    <h1>F.I.</h1>
                    <h2>Formació Industrial</h2>
                    <!-- <div>
                        <img src="img/teacher.png">
                    </div> -->
                    <div>
                        <span>Orientadors</span>
                        <span>i</span>
                        <span>Professors</span>
                    </div>
                </div>
            </a>
        </div>
    </body>
    <script>

        function saveTypeLocalStorage(typeUser){

            if (window.localStorage) {
                localStorage.setItem('typeUser', typeUser);
            } else {
              throw new Error('Tu Browser no soporta LocalStorage!');
            }
        }

    </script>
</html>
