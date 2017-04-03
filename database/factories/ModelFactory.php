<?php



use Illuminate\Support\Facades\Log;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$log = new Logger('Fakers ->');
$log->pushHandler(new StreamHandler('logs/logger.log', Logger::INFO));
$root = base_path();
$path = "/public/images";
$images  = scandir($root.$path);
$imgpath = "http://localhost:8000/img/resource/";


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    $word = $faker->word.rand(0, 10000);
    return [
        'nomTags' => $word,
    ];
});

$factory->define(App\Resource::class, function (Faker\Generator $faker){
    $log = new Logger('Fakers ->');
    $log->pushHandler(new StreamHandler('logs/logger.log', Logger::INFO));
    $root = "C:\\Users\\nicof\\PhpstormProjects\\POO";
    $path = "\\tsfi\\tests\\_data\\images";
    $images  = scandir($root.$path);
    $imgpath = "http://localhost:8000/img/resource/";
    $log->info('Faking Resource');
    return[
        'titol' => $faker->word,
        'subTitol' => $faker->sentence,
        'descDetaill1' => $faker->paragraph,
        'relevancia' => $faker->randomDigit ,
        'visible' => $faker->randomDigit,
        'creatPer' => $faker->name,
        'fotoResum'=> ($imgpath.strval($images[rand (2 ,21 )]))
    ];

});

