<?php

namespace App\Http\Controllers\publiccontrollers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class publicURLs extends Controller
{
    public function autoComplete(Request $request)
    {
        $results = array();
        $queries = Tag::all();
        $results=[];
        foreach ($queries as $query)
        {
            array_push($results,$query->nomTags);
        }

        return $results;
    }
}
