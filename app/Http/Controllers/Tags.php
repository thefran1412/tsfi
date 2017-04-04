<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;

class Tags extends Controller
{
    public function getTags(Request $request) {

    	$searchName = $_GET["q"];

    	 $tags = Tag::where("nomTags","LIKE", "%$searchName%")->get();

         return response()->json([
                'tags' => $tags
            ]);
    }
}
