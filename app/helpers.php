<?php
/**
 * Created by PhpStorm.
 * User: nicof
 * Date: 26/03/2017
 * Time: 21:22
 */
use App\EntityResource;
use App\Resource;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\AgeResource;
use App\TagResource;
use App\CategoryResource;

function setDefaults(Request $request, $field, $table)
{
    $default = null;
    $type = (DB::connection()->getDoctrineColumn($table, $field)->getType()->getName());
    if (!$request[$field]){
        $default=null;
    }else{
        $default=$request[$field];
        if ($type=="boolean"){
            $default=true;
        }
    }
    return $default;
}

function getCorrectDate($date = null)
{
    if (!$date){
        $date = Carbon::now()->format('Y-m-d');
    }
    return date_create_from_format('Y-m-d', $date);
}

function duplicatedRecurs(Request $request, $recurs_id)
{
    var_dump('duplicated recurs');
    if ($request['titolRecurs'] === Resource::find($recurs_id)->titolRecurs)
    dump('duplicated');
}
function addRecursoAge(Request $request, $recurs_id)
{
    var_dump('edades');
    dump($request['multipleage,']);
    foreach ($request['multipleage'] as $age) {
        $agerecurs = new AgeResource;
        $agerecurs->idRecurs = $recurs_id;
        $agerecurs->idEdat = $age;
        $agerecurs->save();
    }
}
function addRecursCategory(Request $request, $recurs_id)
{
    var_dump('categorias');
    $categoria = new CategoryResource;
    $categoria->idCategoria = $request['categorias'];
    $categoria->idRecurs = $recurs_id;
    $categoria->save();
}
function addRecursTag(Request $request, $recurs_id)
{
    $pattern = "/tag\\d+/";
    dump('tags');
    foreach ($request->all() as  $key => $value){
        if (preg_match($pattern, $key)) {
            dump($value);
            $tags = Tag::where('nomTags', $value)->first();
            if($tags) {
                $tag_id = $tags->tags_id;
            } else {
                $tags = new Tag;
                $tags->nomTags = $value;
                $tags->save();
                $tag_id = $tags->tags_id;
            }
            $recursTag = new TagResource;
            $recursTag->idTag = $tag_id;
            $recursTag->idRecurs = $recurs_id;
        }
    }
}
function addRecursEntity (Request $request, $recurs_id)
{
    $entidad = new EntityResource;
    $entidad->idEntitat = $request['entitats'];
    $entidad->idRecurs = $recurs_id;
    $entidad->save();
}

