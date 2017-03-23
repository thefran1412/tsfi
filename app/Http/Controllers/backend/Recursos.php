<?php

namespace App\Http\Controllers\backend;

use App\Resource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;



class Recursos extends Controller
{
    protected  $log;


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
		return view('backend.recursos.add',  ['current_time' => $current_time]);
    }

	public function store(Request $request)
	{
        $request->file('fotoResum')->getSize();
        exit(dump($request->hasFile('fotoResum')));
        if ($request->hasFile('fotoResum')) {
            $extension = '.'.$request->file('fotoResum')->getClientOriginalExtension();
            dump(strval(bcdiv($request->file('fotoResum')->getSize()/1024,1,1)).'KB');
            $uploadOk = 1;
            $target_dir = base_path() . '\public\img\image\\';
            $hash_name = hash('md5',time() . $request->file('fotoResum')->getClientOriginalName()). $extension;
            $target_file= $target_dir . $hash_name;
            dump($target_file);


            if(bcdiv($request->file('fotoResum')->getSize()/1024,1,1)> 2048){
                dump('la imagen ha de ser mas pequeña que 2MB');
                $uploadOk=0;
            }
            if(substr($request->file('fotoResum')->getMimeType(), 0, 5) !== 'image') {
                dump('no es una imagen');
                $uploadOk=0;
            }

            while(file_exists($target_file)){
                dump('igual');
                $target_file = hash('md5',$target_file).$extension;
            }
           $i = 5/0;
            if ($uploadOk >0){

            }else{
                dump('Algo ha ido mal');
            }
        }
//        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//        $uploadOk = 0;
//        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//        // Check if image file is a actual image or fake image
//        // Check if file already exists
//        // Check file size
//        if ($_FILES["fileToUpload"]["size"] > 500000) {
//            echo "Sorry, your file is too large.";
//            $uploadOk = 0;
//        }
//        // Allow certain file formats
//        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//            && $imageFileType != "gif" ) {
//            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//            $uploadOk = 0;
//        }
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
}