<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class PropertyController extends Controller
{

    /**
     * Show the property list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $property = Property::where('id', Request()->id)
            ->get()->first();

        // If property id doesn't exist, show error 404 page
        if(empty($property)) {
            abort(404);
        }

        // Property exists
        return view('property')->with ('property', $property);
    }

    /**
     * Show the property grid.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGrid()
    {
        $properties = Property::paginate(2);
        return view('properties')->with ('properties', $properties);
    }
}
