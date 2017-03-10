<?php

namespace App\Http\Controllers\backend;

use App\Resource;
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
            'C:\Users\nicof\PhpstormProjects\POO\tsfi\logs\logger.log', Logger::INFO));
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
        return view('backend.recursos.index', ['resources' => $r]);
	}
	public function add()
	{
		return view('backend.recursos.add');
    }
	public function store()
	{
	    $this->setLog('Resource store');

        echo gettype($this->log), "\n";
        $data = request()->intersect(['titol','subTitol','descDetaill1','creatPer']);
        $this->setInfoLog($this->log,'data->   '.implode("\n",$data));
        Resource::create($data);
        return redirect()->to('admin/recursos');
	}

    private function setInfoLog(Logger $log, $message)
    {
        $log->info($message);
    }
}
