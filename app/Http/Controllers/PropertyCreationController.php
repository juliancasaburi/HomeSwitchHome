<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Property;
use App\Week;
use DateTime;
use DateInterval;

class PropertyCreationController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.createProperty');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string'],
            'pais' => ['required', 'string'],
            'provincia' => ['required', 'string'],
            'localidad' => ['required', 'string'],
            'calle' => ['required', 'string'],
            'numero' => ['required', 'string',
                /*  Validates Property doesn't already exist.
                    Combination of (country, city, street, property number) must be unique
                */
                Rule::unique('propiedades')->where(function ($query) use ($request) {

                    return $query
                        ->where('pais', $request->pais)
                        ->where('localidad', $request->localidad)
                        ->where('calle', $request->calle)
                        ->where('numero', $request->numero);
                }),
            ],
            'estrellas' => ['required', 'numeric'],
            'capacidad' => ['required', 'numeric'],
            'habitaciones' => ['required', 'numeric'],
            'banios' => ['required', 'numeric'],
            'capacidadVehiculos' => ['required', 'numeric'],
            'foto'     =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($validator->fails()){
            // Return user back and show an error flash message
            return redirect('admin/dashboard/create-property')->withErrors($validator);
        }

        $property = new Property;
        $property->nombre = $request->nombre;
        $property->pais = $request->pais;
        $property->provincia = $request->provincia;
        $property->localidad = $request->localidad;
        $property->calle = $request->calle;
        $property->numero = $request->numero;
        $property->estrellas = $request->estrellas;
        $property->capacidad = $request->capacidad;
        $property->habitaciones = $request->habitaciones;
        $property->baños = $request->banios;
        $property->capacidad_vehiculos = $request->capacidadVehiculos;

        $property->save();

        // Check if a property photo has been uploaded
        if ($request->has('foto')) {
            // Get image file
            $image = $request->file('foto');
            // Make a image name based on property's name and current timestamp
            $name = str_slug($request->input('nombre')).'_'.time();
            // Define folder path
            $folder = '/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'media', $name);
            // Set property photo image path in database to filePath
            $property->image_path = '/uploads'.$filePath;
            $property->save();
        }

        if($request->crearSemanas == 'on'){
            // Create a new DateTime object
            $date = new DateTime();

            // Modify the date to next monday
            $date->modify('next monday');

            // Get year
            $year = $date->format("Y");
            $weekYear = $year;

            // Create all weeks starting from today (or next monday) for current year
            while($weekYear == $year) {
                $strDate = $date->format('Y-m-d');

                // Create a Week and save it
                $week = new Week();
                $week->propiedad_id = $property->id;
                $week->fecha = $strDate;
                $week->save();

                $date->add(new DateInterval('P7D'));
                $weekYear = $date->format("Y");
            }
            return redirect('admin/dashboard/create-property')->with('alert-success', 'Propiedad y semanas creadas!');
        }
        // Return user back and show a flash message
        return redirect('admin/dashboard/create-property')->with('alert-success', 'Propiedad creada exitosamente!');
    }
}