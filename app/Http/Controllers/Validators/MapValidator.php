<?php

namespace App\Http\Controllers\Validators;

use App\Location;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MapValidator
{
    protected $lat;
    protected $lng;

    public function __construct($lat, $lng)
    {
        $this->lat = strval(floatval($lat));
        $this->lng =  strval(floatval($lng));
    }

    public function saveMap()
    {
        if ($this->lat == 0 || $this->lng == 0) {
            return null;
        }

        $exists = $this->exists();
        
        if (!$exists) {
            $location = new Location;
            
            $location->latitud = $this->lat;
            $location->longitud = $this->lng;

            if ($location->save()) {
                return $location->localitzacions_id;
            }
        }
        else{
            return $exists;
        }

        return null;
    }

    public function exists()
    {
        $l = Location::where('latitud', $this->lat)
        ->where('longitud', $this->lng)
        ->first();

        if ($l !== null) {
            return $l->localitzacions_id;
        }
        
        return false;
    }
}