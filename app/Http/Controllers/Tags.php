<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;

class Tags extends Controller
{
    public function getTags(Request $request) {

    	$searchName = $_GET["q"];

    	 $tags = Tag::where("nomTags","LIKE", "%$searchName%")->
    	 where('deleted','=', null)->orWhere('deleted','=', 0)->get();

         return response()->json([
                'tags' => $tags
            ]);
    }
}
