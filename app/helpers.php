<?php
/**
 * Created by PhpStorm.
 * User: nicof
 * Date: 26/03/2017
 * Time: 21:22
 */
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function setDefaults(Request $request, $field, $table)
{
    $default = null;
    $type = (DB::connection()->getDoctrineColumn($table, $field)->getType()->getName());
    if (!$request[$field]){
        if ($type == "integer" or $type=="float"){
            $default = 0;
        }elseif ($type=="boolean"){
            $default = false;
        }elseif($type=="string" or $type=="text"){
            $default="";
        }
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


