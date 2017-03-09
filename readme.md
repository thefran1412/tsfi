# My Laravel Proyect
* [Instalar Laravel](#install)
* [Comandos de laravel](#comandos)
  * [A través de Artisian](#artisian)
  * [Comandos usados en la consola virtual tinker](#tinker)
* [Model](#model)
  * [Foraneas](#foranea)
* [Eloquent](#eloquent)
  * [Uso de Eloquent](#uso_eloquent)  
* [Routes](#routes)
* [Elementos HTML](#elementos_html)
  * [Etiqueta Form](#form)
* [Controllers](#controllers)
* [Request](#request)
* [Traits](#traits)
* [Declarar un error en una Vista](#error_view)
* [Migrations](#migrations)
* [Seeders](#seeder)
  * [Factories](#factories)
* [Exceptions](#exeptions)
  * [MassAssignmentException](#massassignmentexception)
* [Extra](#extra)
  * [Cross Site Request Forgery (CSRF)](#csrf)
  * [MarkDown](#markdown)
  * [Estilos dentro de MarkDown](#estilos)

#<a name="install"></a> Instalar laravel 
```php
composer global require "laravel/installer"
```
Este comando solo se ejecuta una vez para instalar Laravel en el ordenador, es decir, recojemos el instaler global de Laravel.
Para crear un nuevo proyecto:
 ```php
laravel new nombreProyecto
```

#<a name="comandos"></a> Comandos de laravel:
##<a name="artisian"></a> A través de Artisian:
La consola virtual que trae laravel por defecto se llama artisan, esta nos provee de comandos útiles que nos ayudaran a la hora de desarrollar nuestra aplicación.
* `php artisan list` sirve para ver una lista de todos los comandos que nos provee artisan.
* Podemos usar el comando `php artisan serve` para iniciar un servidor virtual de desarrollo.
* `unitest` nos sirve para realizar pruevas sobre nuestras paginas en laravel
* `php artisan make:test nombredeltest` con este comando artisan nos hará automáticamente un archivo test para provar nuestras páginas.
* `php artisan make:model nombredelmodelo` con este creamos un nuevo modelo, si queremos directamente crear el modelo y hacer un archivo de migracion podemos usar al final del comando la opción `-m`.
* `php artisan make:migration create_note_table --create=notes` Asi crearimos la tabla notes.
* Para migrar todos los makemigrations usamos `php artisian migrate`, asi todas las migraciones que tengamos pendientes se migraran a la base de datos.
* Laravel también incluye, dentro de artisan, una consola interactiva llamada __tinker,__ usamos la comanda `php artisan tinker` para poder usar esta consola de php dentro de artisan.
* Podemos con el comando `php artisan route:list` listar todas las rutas que tenemos configuradas en nuestro proyecto.

##<a name="tinker"></a> Comandos usados en la consola virtual tinker:
Dentro de artisan podemos ejecutar otra consola virtual que se conoce como __tinker__ esta nos permite interactuar con todas las clases y métodos que incluye nuestro proyecto, esto nos servirá para realizar pruebas de funcionamiento.
* `\App\Note::truncate();` Elimina todo el contenido de una tabla.

#<a name="model"></a>Model
Los modelos son las clases que definen a los datos alamcenodos en la base de datos estos se muestran como clases dentro de la carpeta `/app`, para crear un modelo usamos la comanda`php artisan make:model NombreDelModelo`, automaticamente laravel creará un modelo con este nombre dentro de la carpeta app `/app/NombreDelModelo`
```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NombreDelModelo extends Model
{
    protected $fillable = ['columna'];
}
```
Dentro del atributo protejido fillable podemos declarar las diferentes columnas dentro de la tabla NombreDelModelo para que estos puedan ser recogidos cuando se les llame a través de una consulta. <span style="color:red;">?</span>

##<a name="foranea"></a>Foranea
Para relacionar un modelo con otro y poder recoger los datos de una tabla que sea forania de otra podemos indicar su relación en el modelo de esta:

```php
    public function getIdNombreDelModelo(){
        return $this->belongsTo(NombreDelModelo::class);
    }
```

* `belongsTo()` nos dice que `$this` es decir el modelo actual pertenece a este otro modelo es decir que el camo Id en la tabla actial es una clave foránea del modelo NombreDelModelo.
#<a name="eloquent"></a> Eloquent
Eloquent es el ORM (Object-Relational mapping, en español mapeo de Objeto-Relacional) que viene por defecto con laravel, este entiende que cada tabla de la base de datos tiene un "Modelo" correspondiente que se usa para interactuar con esta. Los modelos propios del proyecto permiten consultar, insertar, editar y borrar datos dentro de estas tablas.
##<a name="uso_eloquent"></a> Uso de Eloquent:

Por tanto podemos decir que eloquent transforma los datos de la base de datos en objetos que podemos usar dentro de nuestro proyecto. Podemos decirle a  tratar estos objetos y recibirlos como nosotros queremos existen diversas formas para recibirlos.
##<a name="routes"></a>Routes
A la hora de enlazar nuestras paginas en Laravel usamos el archivo de rutas que trae este en `app->Http->routes.php`, en este declaramos las rutas que llevarán a nuestras vistas o al contenido que querramos mostrar. Laravel nos facilita el manejo de entrada de parametros desde la url, podemos poner el nombre que queramos en esta y pasar las variables usando regex:
```php
Route::get('/notes/{note}/{slug?}', function ($notes, $slug = null){
    dd($notes, $slug);
})->where('note', '[0-9]+');
```
* `Route::get()` recoge el enlace que es introducido por el usuario, dentro de los parentesis podemos declarar el enlace el cual pedimos y una función que recoja sus datos, los datos se declaran dentro de `{}`.
* Si queremos que uno de los parametros sea opcional podemos incluir un `?` y indicar  en la función que el valor que pedimos puede ser nulo con `$slug = null`.
* Para que el usuario sólo pueda introducir numeros en un determinado parametro usamos la función `where()` al final del todo especificando que parametro es y la regular expresion que queremos usar si son solo caracteres o numeros etc. En este caso he usado solo números. el `+` indica que puede ser más de un número.

#<a name="elementos_html"></a>Elementos HTML
Laravel necesita ciertas especificaciones para poder usar algunas etiquetas de HTML esto es debido sobretodo `de momento` a cuestiones de seguridad.
##<a name="form"></a>Etiqueta Form
Para poder, con una etiqueta tipo form hacer un submit hemos de incluir un token para que laravel admita el submit y no disparé el error de seguridad CSRF:
```html
<input type="text" name="_token" value="{{ csrf_token() }}">
```
* A aprtir de el under name `_token` y el valor recogido por esta funcion `value="{{csrf_token()}}"` podemos hacer un submit.
* Para que el token no se vea podemos cambiar el tipo de input por `hidden` o usar la funcion que nos proporciona laravel `
        {!! csrf_field() !!}` que genera el token que necesitamos pero sin que el usuario lo pueda ver y sin necsidad de usar un input.

#<a name="controllers"></a>Controllers
Los controladores sirven para declarar toda la lógica de las rutas sin saturar el archivo de rutas que incorpora php, de esta forma podemos refactorizar el código en una clase con métodos llamados desde las diferentes rutas.

Para crear un controlador usamos la comanda `php artisan  make:controller NombreDelControlador` este comando nos creara un controlador con diferentes opciones por defecto su queremos crear un controlador sin  estos metodos usamos la opción `--plain`

#<a name="request"></a>Requests
Esto no es que sea de php pero en fin un <span style="color:r;">recordatorio</span>:
* `request()->all();` recojes toda la entrada que introduce el usuario.
* `return request()->get('note');` recojes solo un campo.
* `return request()->only(['note']);` es como un filter en django recojes los campos que especificas.

También podemos usar la injección de dependencias `Requests`:
```php
use Illuminate\Http\Request;

public function store(Request $request)
    {
        return $request->only(['note']);
    }

```
#<a name="traits"></a>Traits
En los lenguajes de Programación Orientada a Objetos, se nos permite realizar herencias de una o mmultiples clases, pero en PHP no és posible realizar herencias múltiples por ello a partir de la versión 5.4 se añaden los Traits (rasgos) que permiten reutilizar código.

>Los traits (rasgos) son un mecanismo de reutilización de código en lenguajes de herencia simple, como PHP. El objetivo de un trait es el de reducir las limitaciones propias de la herencia simple permitiendo que los desarrolladores reutilicen a voluntad conjuntos de métodos sobre varias clases independientes y pertenecientes a clases jerárquicas distintas. La semántica a la hora combinar Traits y clases se define de tal manera que reduzca su complejidad y se eviten los problemas típicos asociados a la herencia múltiple y a los Mixins.
#<a name="error_view"></a>Declarar un error en una vista
Para declarar un error en una vista usamos la variable/objeto predefinida `$errors` definiendo primero unos criterios de validación a traves de `validate()` una función heredada de `Controllers` heredada a su vez de un trait 
```php
$this->validate(request(), [
    'note' => ['required', 'max:200'
]]);
```
En esta parte definimos la validación que tendrá nuestro campo `note` que recogemos en el request que introduce el usuario, dentro del template hemos de añadir un mensaje de error puesto que el usuario en estos momentos no puede añadir nada que vaya contra nuestros criterios pero no le decimos el porque no puede añadir su contenido:
```php
@if(! $errors->isEmpty())
<div class="alert alert-danger">
    <p>Tu nota no cumple los requisitos</p>
    <ul>
    @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif
```
A partir de este código podemos ver que primero, se comprueva que alla algun error en el objeto `$errors`, este es una variable por defecto de laravel que nos devuelve los errores del trait `validate()`, si esta no está vacia añadimos los diferentes mensajes de error que por defecto nos devuelve laravel.

#<a name="migrations"></a>Migrations
Las migraciones son un registro de todos los cambios que se aplican en la base de datos, una herramienta útil para poder compartir la estructura de la base de datos y realizar cambios de una forma ordenada, podemos construir la base de datos desde cero a través del sistema de migraciones que usa Laravel. 

#<a name="seeder"></a>Seeders
Para poder hacer pruebas útiles dentro de nuestro proyecto podemos crear semillas que generaran datos preestablecidos y así poder realizar las pruevas pertinentes sin necesidad de insertar datos manualmente.

Para crear una `seeder`(semilla) hemos de dirigirnos a `/database/seeds` dentro crear una nueva semilla manualmente o a partir del comando php artisan `make:seeder NombreDelSeeder` una vez hecho esto podemos ver que se ha creado el archivo `NombreDelSeeder.php` dentro observamos la estructura del seeder:
```php
<?php

use Illuminate\Database\Seeder;

class NombreDelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i<=100; $i++){
            \App\Note::create(['note'=>"note $i"]);
        }
    }
}
```
Dentro del método run podemos realizar los inserts que creamos convenientes en nuestro proyecto.

Después de esto para poder usar nuestro nuevo seeder hemos de añadirlo dentro de `/database/seeds/DatabaseSeeder.php` aquí es donde se declaran todos los seeders que vamos a usar cuando ejecutemos la comanda `php artisan db:seed` que es la que se encarga de aplicar todos los seeders en la base de datos.

##<a name="factories"></a>Factories
Para crear de manera automática contenido para la página web que se parezca más a un contenido real podemos usar el componente `/database/factories/ModelFactory.php` dentro de este definimos un nuevo factory:
```php
$factory->define(App\Note::class, function (Faker\Generator $faker){

    return[
        'note' => $faker->paragraph
    ];

});
```
Definimos un nuevo factory pasando la clase de nuestro modelo y el generador de faker. Dentro se define un array con los datos que retornará el factory.

__Faker__ es un componente de terceros que nos provee de metodos para crear datos de forma aleatoria, como correos, nombres de usuarios, y en este caso parrafos etc. Dentro de nuestro seeder en vez de declarar un bucle o similares para añadir datos llamamos al método factory para usar el nuevo factory que hemos creado:
```php
 factory(\App\Note::class)->times(100)->create();
```

#<a name="exeptions"></a>Exceptions
##<a name="massassignmentexception"></a> MassAssignmentException.
Excepción que salta cuando intentamos pasar las propiedades del objeto al constructor del modelo, para que no nos de este error las hemos de listar y pasarlas en un array con:
```
protected $fillable = ['Propieda/AtributoaSerCargado']
```
Así nos dicen en este ilo de [Stackoverflow](http://stackoverflow.com/questions/26724117/laravel-mass-assignment-exception-error "Laravel - Mass Assignment Exception error") 
>To be able to set properties by passing them to the model's constructor, you need to list all the properties you need in the $fillable array.

#<a name="extra"></a>Extra
##<a name="csrf"></a>Cross Site Request Forgery (CSRF)
Falsificación de petición en sitios cruzados (en español) es un ataque que fuerza al navegador web validado de una víctima a enviar una petición a una aplicación web vulnerable, la cual entonces realiza la acción elegida a través de la víctima. Al contrario que en los ataques XSS, este se beneficia de la  la confianza que un sitio tiene en un usuario en particular, `Dulio =>`para que un sitio se haga pasar por otro sitio.

En este caso Laravel nos ayuda a evitar este tipo de ataques.

Para evitar un error de estetipo podemos incluir en nuestras clases que no se usen los __Middlewares,__ que son aquellos que estan ente el cliente y el servidor revisando lo que deban revisar porque podemos crear nuestros propios __Middlewares,__ para que no nos salte el error de __CSRF token__ podemos deshabilitar estos __Middlewares__ usando: `use WithoutMiddleware;`

##<a name="markdown"></a>MarkDown:
###<a name="estilos"></a>Estilos dentro de MarkDown
Para poder añadir estilos en Markdown necesitamos envolver el texto al cual queremos añadirle un estilo con la etiqueta HTML `<span>` y dentro de esta incluir la propiedad `style="color:red";`:
```markdown
<span style="color:red;">Este texto es color rojo</span>
```
<span style="color:red;">Este texto es color rojo</span>

En el preprocesado de Github para MarkDown no renderiza esta etiqueta span con el estilo que queremos.

    