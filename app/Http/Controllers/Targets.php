<?php

namespace App\Http\Controllers;
use App\Target;
use Illuminate\Http\Request;

class Targets extends Controller
{
    public function getTargets(Request $request) {

    	 $targets = Target::get();

         return response()->json([
                'targets' => $targets
            ]);
    }
}
