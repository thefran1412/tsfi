<?php

namespace App\Http\Controllers\backend;


use App\Age;
use App\AgeResource;
use App\CategoryResource;
use App\Entity;
use App\EntityResource;
use App\Http\Controllers\Validators\ImageValidator;
use App\ImageResource;
use App\Link;
use App\Podcast;
use App\Resource;
use App\Target;
use App\TargetResource;
use App\VideoResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use \App\Category;
use \App\Tag;
use stdClass;

class Recursos extends Controller
{
    protected $log;
    protected $loginPath = '/admin/login';
    protected $fotoResum;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $r = Resource::All();
        $v = Resource::where('visible', 0)->get();
        return view('backend.recursos.index', ['resources' => $r, 'pendents' => $v]);
    }
    public function add()
    {
        $categorias = objectToArrayAndPleaseSelect($categorias = Category::pluck('nomCategoria', 'categoria_id'));
        $entitats = objectToArrayAndPleaseSelect(Entity::pluck('nomEntitat', 'entitat_id'));
        $edats = Age::pluck('descEdat', 'edats_id');
        $targets = Target::pluck('target', 'targets_id');
        $current_time = Carbon::now()->format('Y-m-d');
        return view('backend.recursos.add',[
                'edats'=>$edats,
                'categorias'=>$categorias,
                'entitats'=>$entitats,
                'targets'=>$targets
            ]
        );
    }
    public function store(Request $request)
    {
//        \App\Resource::truncate();
//        \App\AgeResource::truncate();
//        \App\CategoryResource::truncate();
//        \App\EntityResource::truncate();
//        \App\ImageResource::truncate();
//        \App\TagResource::truncate();
//        \App\TargetResource::truncate();
        $this->setLog('Resource store =>');
        $inputimage = 'fotoResum';
        if ($request->hasFile($inputimage)) {
            $validateimage = new ImageValidator($request, $inputimage);
            if ($validateimage->validateImage(null,4000)){
                $validateimage->saveImage();
                $this->setInfoLog($this->log,sprintf('Se guardó la imagen "%s" en la carpeta "%s"',
                    $validateimage->getHashName(), $validateimage->getTargetFile()));
                    $this->fotoResum = $validateimage->getNewImagePath();
            }else{
                $validateimage->errorUpoad();
            }
        }
        $recurso = Resource::Create([
            'titolRecurs' => $request['titolRecurs'],
            'subTitol' => setDefaults($request, 'subTitol', 'recursos'),
            'descBreu' => setDefaults($request, 'descBreu', 'recursos'),
            'creatPer' => setDefaults($request, 'creatPer', 'recursos'),
            'descDetaill1' => setDefaults($request, 'descDetaill1', 'recursos'),
            'descDetaill2' => setDefaults($request, 'descDetaill2', 'recursos'),
            'relevancia' => setDefaults($request, 'relevancia', 'recursos'),
            'dataInici' => getCorrectDate($request['dataInici']),
            'dataFinal' => getCorrectDate($request['dataFinal']),
            'gratuit' => setDefaults($request, 'gratuit', 'recursos'),
            'preuInferior' => setDefaults($request, 'preuInferior', 'recursos'),
            'preuSuperior' => setDefaults($request, 'preuSuperior', 'recursos'),
            'dataPublicacio' => getCorrectDate($request['dataPublicacio']),
            'created-at' => getCorrectDate()->getTimestamp(),
            'updated_at' => getCorrectDate()->getTimestamp(),
            'visible' => setDefaults($request,'visible', 'recursos'),
            'fotoResum' => $this->fotoResum
        ]);


        $insertedId = $recurso->recurs_id;
        if($request['multipleage']!== null)addRecursoAge($request, $insertedId);
        if($request['categorias'] !== null)upsertRecursCategory($request, $insertedId);
        upsertImageResource($request, $insertedId);
        upsertRecursTag($request, $insertedId);
        if($request['entitats'] !== null)upsertRecursEntity($request, $insertedId);
        upsertRecursPodcast($request, $insertedId);
        if($request['linkrecurs'] !== null)addRecursLinks($request, $insertedId);
        upsertRecursVideo($request, $insertedId);
        if($request['target'])upsertRecursTarget($request, $insertedId);

        return redirect()->to('admin/recursos');
    }

    public function edit($id)
    {
        $recurso = Resource::find($id);


        $categorias = objectToArrayAndPleaseSelect($categorias = Category::pluck('nomCategoria', 'categoria_id'));

        $selectedCategoria = CategoryResource::where(['idRecurs'=>$id])->first();
        if ($selectedCategoria){
            $selectedCategoria = $selectedCategoria->idCategoria;
        }

        $entitats = objectToArrayAndPleaseSelect(Entity::pluck('nomEntitat', 'entitat_id'));
        $selectedEntitat = EntityResource::where(['idRecurs'=>$id])->first();
        if ($selectedEntitat){
            $selectedEntitat = $selectedEntitat->idEntitat;
        }

        $arrayedats = [];
        $edats = Age::pluck('descEdat', 'edats_id');
        $selectedAge = AgeResource::where('idRecurs', $id)->get();
        foreach ($selectedAge as $ageid){
            array_push($arrayedats,$ageid->idEdat);
        }

        $selectedTags = $recurso->tag()->where('idRecurs', $id)->get();

        $selectedLinks = Link::where(['idRecurs' => $id])->pluck('link')->toArray();
        foreach ($selectedLinks as $key => $val) {
            $selectedLinks[$key] = $val.';';
        }

        $targets = Target::pluck('target', 'targets_id');

        $selectedtarget = TargetResource::where(['idRecurs' =>$id])->first();
        if($selectedtarget){
            $selectedtarget=$selectedtarget->idTarget;
        }

        $video_recurs = VideoResource::where(['idRecurs' => $id])->get();
        $image_recurs = ImageResource::where(['idRecurs' => $id])->get();
        $podcast_recurs = Podcast::where(['idRecurs' => $id])->get();
        return view('backend.recursos.edit',[
                'edats'=>$edats,
                'categorias'=>$categorias,
                'entitats'=>$entitats,
                'targets'=>$targets,
                'selectedtarget'=>$selectedtarget,
                'selectedCategoria'=>$selectedCategoria,
                'selectedEntitat'=>$selectedEntitat,
                'arrayedats'=>$arrayedats,
                'id'=>$id,
                'recurso'=>$recurso,
                'selectedTags'=>$selectedTags,
                'video_recurs'=>$video_recurs,
                'image_recurs'=>$image_recurs,
                'podcast_recurs'=>$podcast_recurs,
                'selectedLinks'=>$selectedLinks
            ]
        );
    }
    public function update($id, Request $request)
    {
        $this->setLog('Resource update =>');
        $inputimage = 'fotoResum';

        $recurso = Resource::find($id);
        if ($recurso){
            $recurso->titolRecurs = $request['titolRecurs'];
            $recurso->subTitol = setDefaults($request, 'subTitol', 'recursos');
            $recurso->descBreu = setDefaults($request, 'descBreu', 'recursos');
            $recurso->creatPer = setDefaults($request, 'creatPer', 'recursos');
            $recurso->descDetaill1 = setDefaults($request, 'descDetaill1', 'recursos');
            $recurso->descDetaill2 = setDefaults($request, 'descDetaill2', 'recursos');
            $recurso->relevancia = setDefaults($request, 'relevancia', 'recursos');
            $recurso->dataInici = getCorrectDate($request['dataInici']);
            $recurso->dataFinal = getCorrectDate($request['dataFinal']);
            $recurso->gratuit = setDefaults($request, 'gratuit', 'recursos');
            $recurso->preuInferior =  setDefaults($request, 'preuInferior', 'recursos');
            $recurso->preuSuperior =  setDefaults($request, 'preuSuperior', 'recursos');
            $recurso->dataPublicacio = getCorrectDate($request['dataPublicacio']);
            $recurso->visible = setDefaults($request,'visible', 'recursos');
            $recurso->fotoResum = uppsertFotoresum($request);
            $recurso->save();
        }

        $insertedId = $recurso->recurs_id;
        if($request['multipleage'] !== null)addRecursoAge($request, $insertedId);
        if($request['categorias'] !==null)upsertRecursCategory($request, $insertedId);
        upsertImageResource($request, $insertedId);
        upsertRecursTag($request, $insertedId);
        if($request['entitats'] !== null)upsertRecursEntity($request, $insertedId);
        if($request['linkrecurs'] !== null)addRecursLinks($request, $insertedId);
        upsertRecursPodcast($request, $insertedId);
        upsertRecursVideo($request, $insertedId);
        if($request['target'] !== null)upsertRecursTarget($request, $insertedId);

        return redirect()->to('admin/recursos');
    }
    private function validateEntity($request)
    {
        $this->validate($request, [
            'nom' => 'required|max:255',

            'telf1' => 'required|min:9|max:9',
            'telf2' => 'min:9|max:9',

            'link' => 'url|max:255',
            'facebook' => 'url|max:255',
            'twitter' => 'url|max:255',
            'instagram' => 'url|max:255',

            'logo' => 'required',
            'adreca' => 'max:255',
        ]);

    }
    private function setInfoLog(Logger $log, $message)
    {
        $log->info($message);
    }
    public function setLog($log)
    {
        $this->log = new Logger($log);
        $this->log->pushHandler(new StreamHandler(
            base_path().'\logs\logger.log', Logger::INFO));
    }
}