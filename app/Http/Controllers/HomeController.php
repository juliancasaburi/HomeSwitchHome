<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class HomeController extends Controller
{

    /**
     * Show the property list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::orderBy('created_at', 'desc')->take(3)->get();

         // Return view
        return view('index', [
            'properties' => $properties,
        ]);
    }
}
