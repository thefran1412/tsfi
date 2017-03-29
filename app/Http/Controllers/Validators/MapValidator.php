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
        $this->lat = floatval($lat);
        $this->lng =  floatval($lng);
    }

    public function saveMap()
    {
        if ($this->lat == 0 || $this->lng == 0) {
            echo 'entered';
            exit();
            return null;
        }
        $location = new Location;

        $location->latitud = $this->lat;
        $location->longitud = $this->lng;

        if ($flight->save()) {
            return $location->id;
        }


    }
}