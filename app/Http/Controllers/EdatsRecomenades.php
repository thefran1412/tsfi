<?php

namespace App\Http\Controllers;
use App\Age;
use Illuminate\Http\Request;

class EdatsRecomenades extends Controller
{
        public function getAge(Request $request) {

    	 $ages = Age::get();

         return response()->json([
                'ages' => $ages
            ]);
    }
}
