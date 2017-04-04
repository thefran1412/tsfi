<?php
/**
 * Created by PhpStorm.
 * User: nicof
 * Date: 26/03/2017
 * Time: 21:22
 */
use App\EntityResource;
use App\Link;
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
            $recursTag->save();
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
function addRecursLinks(Request $request, $recurs_id)
{
    $urls = explode(';', $request['linkrecurs']);
    for ($i = 0; $i<count($urls); $i++){
        $url = preg_replace('/\s+/', '', $urls[$i]);
        preg_match_all('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si', $url, $result);
        $temp_url = (!preg_match('#^(ht|f)tps?://#', $url)) // check if protocol not present
            ? 'http://' . $url // temporarily add one
            : $url; // use current
        if (filter_var($temp_url, FILTER_VALIDATE_URL) !== false) {
            dump($url);
            $link = new Link;
            $link->link = $url;
            $link->idRecurs = $recurs_id;
            $link->save();
        }
    }
}
function addRecursVideo(Request $request, $recurs_id)
{

}
