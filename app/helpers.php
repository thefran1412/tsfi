<?php
/**
 * Created by PhpStorm.
 * User: nicof
 * Date: 26/03/2017
 * Time: 21:22
 */
use App\EntityResource;
use App\Http\Controllers\Validators\ImageValidator;
use App\Http\Controllers\Validators\MapValidator;
use App\ImageResource;
use App\Link;
use App\Resource;
use App\Tag;
use App\Target;
use App\TargetResource;
use App\VideoResource;
use App\VideoType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\AgeResource;
use App\TagResource;
use App\CategoryResource;


function objectToArrayAndPleaseSelect($object){
    $new_array = [];
    foreach ($object as $key => $item){
        $new_array[$key] = $item;
    }
    $new_array = array_merge(['0'=>'Selecciona una opcion'], $new_array);
    return $new_array;
}

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
    if ($request['titolRecurs'] === Resource::find($recurs_id)->titolRecurs);
}
function addRecursoAge(Request $request, $recurs_id)
{
    $new_ages = [];
    if (!AgeResource::where('idRecurs', $recurs_id)->first()){
        $all_ages = [];
    }else{
        $all_ages = AgeResource::where('idRecurs', $recurs_id)->pluck('idEdat')->toArray();
    }
    foreach ($request['multipleage'] as $age) {
        $age_recurs = AgeResource::where(['idEdat'=>$age, 'idRecurs' =>$recurs_id])->first();
        if (!$age_recurs){
            $age_recurs = new AgeResource;
            $age_recurs->idRecurs = $recurs_id;
            $age_recurs->idEdat = $age;
            $age_recurs->save();
        }
        array_push($new_ages, $age);
    }
    $tags_to_delete = array_diff($all_ages, $new_ages);
    if ($tags_to_delete){
        foreach ($tags_to_delete as $item) {
            $delet_tags = AgeResource::where(['idEdat'=>$item, 'idRecurs' =>$recurs_id])->first();
            $delet_tags->delete();
        }
    }
}
function upsertRecursCategory(Request $request, $recurs_id)
{
    $categoria = CategoryResource::where(['idRecurs' => $recurs_id])->first();
    if ($request['categorias'] !== '0'){
        if (!$categoria) {
            $categoria = new CategoryResource;
            $categoria->idCategoria = $request['categorias'];
            $categoria->idRecurs = $recurs_id;
            $categoria->save();
        }else{
            $categoria->idCategoria = $request['categorias'];
            $categoria->save();
        }
    }else{
        if ($categoria) {
            $categoria->delete();
        }
    }
}
function upsertRecursTag(Request $request, $recurs_id)
{
    $pattern = "/tag\\d+/";
    $new_tags = [];
    if (!TagResource::where('idRecurs', $recurs_id)->first()){
        $all_tags = [];
    }else{
        $all_tags = TagResource::where('idRecurs', $recurs_id)->pluck('idTag')->toArray();
    }
    foreach ($request->all() as  $key => $value){
        if (preg_match($pattern, $key)) {
            $value = strtolower($value);
            $tags = Tag::where('nomTags', $value)->first();
            if($tags) {
                $tag_id = $tags->tags_id;
            } else {
                $tags = new Tag;
                $tags->nomTags = $value;
                $tags->save();
                $tag_id = $tags->tags_id;
            }
            $tags_recurs = TagResource::where(['idTag'=>$tag_id, 'idRecurs' =>$recurs_id])->first();
            if (!$tags_recurs){
                $recursTag = new TagResource;
                $recursTag->idTag = $tag_id;
                $recursTag->idRecurs = $recurs_id;
                $recursTag->save();
            }
            array_push($new_tags, $tag_id);
        }
    }
    $tags_to_delete = array_diff($all_tags, $new_tags);
    if ($tags_to_delete){
        foreach ($tags_to_delete as $item) {
            $delet_tags = TagResource::where(['idTag'=>$item, 'idRecurs' =>$recurs_id])->first();
            $delet_tags->delete();
        }
    }
}
function upsertRecursEntity (Request $request, $recurs_id)
{
    $entidad = EntityResource::where(['idRecurs' => $recurs_id])->first();
    if ($request['entitats'] !== '0') {
        if (!$entidad) {
            $entidad = new EntityResource;
            $entidad->idEntitat = $request['entitats'];
            $entidad->idRecurs = $recurs_id;
            $entidad->save();
        } else {
            $entidad->idEntitat = $request['entitats'];
            $entidad->idRecurs = $recurs_id;
            $entidad->save();
        }
    }else{
        if ($entidad) {
            $entidad->delete();
        }
    }
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
            $link = new Link;
            $link->link = $url;
            $link->idRecurs = $recurs_id;
            $link->save();
        }
    }
}
function get_numerics ($str) {
    preg_match_all('/\d+/', $str, $matches);
    return $matches[0];
}
function upsertImageResource(Request $request, $recurs_id)
{
    $pattern = "/image\\d+/";
    $new_images = [];
    if (!ImageResource::where('idRecurs', $recurs_id)->first()) {
        $all_images = [];
    } else {
        $all_images = ImageResource::where('idRecurs', $recurs_id)->pluck('titolImatge')->toArray();
    }

    foreach ($request->all() as $key => $value) {
        if (preg_match($pattern, $key)) {
            if ($request->hasFile($key)) {
                $validate_image = new ImageValidator($request, $key);
                if ($validate_image->validateImage(null, 4000)) {
                    dump($request->file($key)->getClientOriginalName());
                    $img_original_name = $request->file($key)->getClientOriginalName();
                    $img_recurso = ImageResource::where(['idRecurs' => $recurs_id, 'titolImatge' => $img_original_name])->first();
                    if (!$img_recurso) {
                        $img_recurso = new ImageResource;
                        $img_recurso->titolImatge = $img_original_name;
                        $img_recurso->imatge = $validate_image->getNewImagePath();
                        $img_recurso->ordre = get_numerics($key)[0];
                        $img_recurso->idRecurs = $recurs_id;
                        $img_recurso->save();
                        $validate_image->saveImage();
                    }
                    array_push($new_images, $img_original_name);
                } else {
                    $validate_image->errorUpload();
                }
            }
        }
        if (preg_match("/delimage\\d+/", $key)) {
            array_push($new_images, $value);
        }
    }
    $imgs_to_delete = array_diff($all_images, $new_images);
    if ($imgs_to_delete) {
        foreach ($imgs_to_delete as $item) {
            $delet_tags = ImageResource::where(['titolImatge' => $item, 'idRecurs' => $recurs_id])->first();
            $delet_tags->delete();
        }
    }
}
function upsertRecursVideo(Request $request, $recurs_id)
{
    $pattern = "/video\\d+/";
    $new_videos = [];
    if (!VideoResource::where('idRecurs', $recurs_id)->first()){
        $all_videos = [];
    }else{
        $all_videos = VideoResource::where('idRecurs', $recurs_id)->pluck('urlVideo')->toArray();
    }
    foreach ($request->all() as  $key => $value){
        if (preg_match($pattern, $key)) {
            $titolVideo = 'Video recurso';
            dump($value);
            $videoRecurs = VideoResource::where(['idRecurs'=>$recurs_id, 'urlVideo' => $value])->first();
            if (!$videoRecurs){
                if (strpos($value, 'youtube')) {
                    $tipus_video = 1;
                    $video_id = substr($value, strrpos($value, '/')+1);
                    if($content = file_get_contents("http://youtube.com/get_video_info?video_id=".$video_id)){
                        parse_str($content, $ytarr);
                        if (array_key_exists('title', $ytarr)){
                            $titolVideo = $ytarr['title'];
                        }else{
                            $titolVideo = 'Video Recurs';
                        }
                    }
                } else if (strpos($value, 'vimeo')){
                    $tipus_video = 2;
                    $video_id = substr($value, strrpos($value, '/')+1);
                    if($content = file_get_contents("http://vimeo.com/api/v2/video/".$video_id.".json")){
                        $hash = json_decode($content);
                        $titolVideo = $hash[0]->title;
                    }
                }else{
                    $tipus_video = 2;
                    strpos($value, 'iframe');
                }
                $videoRecurs = new VideoResource;
                $videoRecurs->idRecurs = $recurs_id;
                $videoRecurs->urlVideo = $value;
                $videoRecurs->idTipus = $tipus_video;
                $videoRecurs->titolVideoRecurs = $titolVideo;
                $videoRecurs->save();
            }
            array_push($new_videos, $value);
        }
    }
    $videos_to_delete = array_diff($all_videos, $new_videos);
    if ($videos_to_delete){
        foreach ($videos_to_delete as $item) {
            $delet_tags = VideoResource::where(['urlVideo'=>$item, 'idRecurs' =>$recurs_id])->first();
            $delet_tags->delete();
        }
    }
}

function upsertRecursTarget(Request $request, $recurs_id)
{
    $target = $request['target'];
    $targetrecurs = TargetResource::where(['idRecurs'=>$recurs_id])->first();
    if (!$targetrecurs){
        $targetrecurs = new TargetResource;
        $targetrecurs->idTarget = $target;
        $targetrecurs->idRecurs = $recurs_id;
        $targetrecurs->save();
    }else{
        $targetrecurs->idTarget = $target;
        $targetrecurs->idRecurs = $recurs_id;
        $targetrecurs->save();
    }
}
function addRecursLocalitzacio(Request $request, $recurs_id)
{
    $validatemap = new MapValidator($request['lat'], $request['lng']);
    $locId = $validatemap->saveMap();
    if ($locId == null) {
        $request['adreca'] = null;
    }
}