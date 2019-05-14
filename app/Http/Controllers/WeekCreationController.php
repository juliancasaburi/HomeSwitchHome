<?php

namespace App\Http\Controllers;

use App\Week;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WeekCreationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.createWeek');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dia' => ['required', 'date'],
        ]);

        if($validator->fails()){
            // Return user back and show an error flash message
            return redirect('admin/dashboard/create-week')->withErrors($validator);
        }

        $week = new Week();
        $week->propiedad_id = $request->idPropiedad;
        $week->fecha = $request->dia;

        $week->save();

        return redirect('admin/dashboard/create-week')->with('alert-success', 'Semana creada exitosamente!');
    }
}
