<?php

namespace App\Http\Controllers\backend;

use App\Age;
use App\Http\Controllers\Validators\ImageValidator;
use App\Resource;
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
//        $this->middleware('auth');
    }

    public function index()
    {
        $r = Resource::All();
        $v = Resource::where('visible', 0)->get();
        return view('backend.recursos.index', ['resources' => $r, 'pendents' => $v]);
    }
    public function autoCompleteCategory(Request $request)
    {
        $categories = Category::all('nomCategoria', 'codiCategoria');
        $obj = ['query'=>'Unit'];
        $values=[];
        foreach ($categories as $category){
            $cat = ['value' => $category->nomCategoria, 'data' => $category->cosiCategoria];
            array_push ($values,$cat);
        }
        $obj['suggestions']=$values;
        return response()->json($obj);
    }
    public function autoComplete(Request $request)
    {
        $term = null;
        if($request['term']){
            $term = $request['term'];
        }

        $results = array();
        $queries = Tag::where('nomTags', 'LIKE', "{$term}%")->take(5)->get();
        $results=[];
        foreach ($queries as $query)
        {
            array_push($results,$query->nomTags);
        }

        return $results;
    }
    public function add()
    {
        $categorias = Category::all('nomCategoria', 'categoria_id');
        $edats = Age::pluck('descEdat', 'edats_id');
        $current_time = Carbon::now()->format('Y-m-d');
        return view('backend.recursos.add',[
                'edats'=>$edats,
                'categorias'=>$categorias
            ]
        );
    }
    public function store(Request $request)
    {
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
        }else{
            dump('no hay archivo');
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
        dump($insertedId);
        dump($request['multipleage']);
        dump($request['']);
        exit();
        $this->setInfoLog($this->log,'data->   '.implode("\n",$data));
        Resource::create($data);
        return redirect()->to('admin/recursos');
    }

    public function edit($id)
    {
        $recurs = Resource::find($id);
        return view('backend.recursos.edit',  ['recurs' => $recurs]);
    }
    public function update($id, Request $request)
    {
        //echo 'hola ';
        //var_dump($request);
        $recurs = Resource::find($id);
        $recurs->fill($request->all());
        $recurs->save();
        return redirect('admin/recursos');
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