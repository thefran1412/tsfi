<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Validators\ImageValidator;
use App\Resource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Recursos extends Controller
{
    protected $log;

    public function setLog($log)
    {
        $this->log = new Logger($log);
        $this->log->pushHandler(new StreamHandler(
            'C:\wamp64\www\tsfi\logs\logger.log', Logger::INFO));
    }

    protected $loginPath = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $current_time = Carbon::now()->format('Y-m-d');
        return view('backend.recursos.add', ['current_time' => $current_time]);
    }

//    public function validateImage(Request $request)
//    {
//        // Condicionales de arriba a abajo
//        // Comprueva si request tiene un archivo para subir
//        // Comprueba el tamaño del archivo no exceda 2mb
//        // Comprueba si el archivo es una imagen
//        // Comprueba la extensión de la imagen entre jpg, jpeg y png
//        $uploadOk = false;
//        if ($request->hasFile('fotoResum')) {
//            $extension = '.'.$request->file('fotoResum')->getClientOriginalExtension();
//            dump(strval(bcdiv($request->file('fotoResum')->getSize()/1024,1,1)).'KB');
//            $imagefiletype = $request->file('fotoResum')->getClientOriginalExtension();
//            $target_dir = base_path() . '\public\img\image\\';
//            $hash_name = hash('md5',time() . $request->file('fotoResum')->getClientOriginalName()). $extension;
//            $target_file= $target_dir . $hash_name;
//            dump($target_file);
//
//            if(bcdiv($request->file('fotoResum')->getSize()/1024,1,1)< 2048){
//                dump('la imagen ha de ser mas pequeña que 2MB');
//                $uploadOk=true;
//            }
//            if(substr($request->file('fotoResum')->getMimeType(), 0, 5) === 'image') {
//                dump('no es una imagen');
//                $uploadOk=true;
//            }
//            if($imagefiletype == 'jpg' or $imagefiletype == 'png' or $imagefiletype == 'jpeg'){
//                $uploadOk = true;
//            }
//            while(file_exists($target_file)){
//                dump('igual');
//                $target_file = hash('md5',$target_file).$extension;
//            }
//        }
//
//
//        return $uploadOk;
//    }
	public function store(Request $request)
	{
        if ($request->hasFile('fotoResum')) {
            # code...
            $validateimage = new ImageValidator($request, 'fotoResum');
    	    var_dump($validateimage->validateImage());
        }
        else{
            echo 'no hay archiva';
        }
        exit();
	    // $error = 5/0;
//        $this->validateEntity($request);
        //        // Check if $uploadOk is set to 0 by an error
//        if ($uploadOk == 0) {
//            echo "Sorry, your file was not uploaded.";
//        // if everything is ok, try to upload file
//        } else {
//            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
//            } else {
//                echo "Sorry, there was an error uploading your file.";
//            }
//        }
	    $this->setLog('Resource store');
        echo gettype($this->log), "\n";
        $data = $request->intersect([
            'titolRecurs',
            'subTitol',
            'descBreu',
            'descDetaill1',
            'descDetaill2',
            'relevancia',
            'dataInici',
            'dataFinal',
            'gratuit',
            'preuInferior',
            'preuSuperior',
            'dataPublicacio',
            'visible',
            'fotoResum',
            'creatPer'
        ]);
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

    private function setInfoLog(Logger $log, $message)
    {
        $log->info($message);
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
}