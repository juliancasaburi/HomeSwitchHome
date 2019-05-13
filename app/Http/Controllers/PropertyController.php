<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class PropertyController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $property = Property::where('id', Request()->id)
            ->get()->first();
        return view('property')->with ('property', $property);
    }
}
