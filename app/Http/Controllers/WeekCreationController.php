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
        // Is input a YYYY-MM-DD date?
        $validator = Validator::make($request->all(), [
            'fecha' => ['required', 'date'],
        ]);

        if($validator->fails()){ // Input is not a YYYY-MM-DD date
            // Redirect back and show an error flash message
            return redirect('admin/dashboard/create-week')->withErrors($validator);
        }

        /*
        |--------------------------------------------------------------------------
        | Date validation
        |--------------------------------------------------------------------------
        */

        // Convert YYYY-MM-DD from $request to a Unix timestamp
        $formDate = strtotime($request->fecha);

        // Get the day of the week using PHP's date function.
        $dayOfWeek = date("l", $formDate);

        // Is it monday?
        if($dayOfWeek  == 'Monday') {

            // Create a Week and save it
            $week = new Week();
            $week->propiedad_id = $request->idPropiedad;
            $week->fecha = $request->fecha;
            $week->save();

            // Redirect back and flash success message
            return redirect('admin/dashboard/create-week')->with('alert-success', 'Semana creada exitosamente!');
        }
        else { // Day is not Monday
            // Redirect back and flash error message
            return redirect('admin/dashboard/create-week')->withErrors(['fecha' => ['El día de la fecha elegida no es lunes']]);
        }
    }
}
