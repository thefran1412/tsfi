<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Validators\ImageValidator;
use App\Resource;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

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

    public function add()
    {
        $current_time = Carbon::now()->format('Y-m-d');
        return view('backend.recursos.add', ['current_time' => $current_time]);
    }
    public function store(Request $request)
    {
        $recurso = new Resource;
        $this->setLog('Resource store');
        $inputimage = 'fotoResum';
        dump($request->hasFile($inputimage));
        if ($request->hasFile($inputimage)) {
            $validateimage = new ImageValidator($request, $inputimage);
            dump($validateimage);
            if ($validateimage->validateImage(null,4000)){
                $validateimage->saveImage();
                $this->setInfoLog($this->log,sprintf('Se guardó la imagen "%s" en la carpeta "%s"',
                    $validateimage->getHashName(), $validateimage->getTargetFile()));
                $this->fotoResum = $validateimage->getTargetFile();
                dump($validateimage->getTargetFile());
            }else{
                $validateimage->errorUpoad();
            }
        }
        /*foreach ($requests as $key => $request) {
            $request = setDefaults($request, $key, 'recursos');
        }*/

        \App\Resource::Create([
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
            'visible' => setDefaults($request,'visible', 'recursos'),
            'fotoResum' => $this->fotoResum
        ]);
dump($this->fotoResum);
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