<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class PropertyCreationController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.createProperty');
    }

    public function store(Request $request)
    {
        // Form validation
        $request->validate([
            'nombre' => ['required', 'string'],
            'pais' => ['required', 'string'],
            'provincia' => ['required', 'string'],
            'localidad' => ['required', 'string'],
            'calle' => ['required', 'string'],
            'numero' => ['required', 'string',
                /*  Valida que la propiedad no exista.
                    La combinacioón (localidad, calle, número) debe ser única
                */
                Rule::unique('properties')->where(function ($query) use ($request) {

                    return $query
                        ->whereLocalidad($request->localidad)
                        ->whereCalle($request->calle)
                        ->whereNumero($request->numero);
                }),
                ],
            'precio' => ['required', 'numeric'],
            'estrellas' => ['required', 'numeric'],
            'capacidad' => ['required', 'numeric'],
            'habitaciones' => ['required', 'numeric'],
            'banios' => ['required', 'numeric'],
            'garages' => ['required', 'numeric'],
            'foto'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $property = new Property;
        $property->nombre = $request->nombre;
        $property->pais = $request->pais;
        $property->provincia = $request->provincia;
        $property->localidad = $request->localidad;
        $property->calle = $request->calle;
        $property->numero = $request->numero;
        $property->precio = $request->precio;
        $property->estrellas = $request->estrellas;
        $property->capacidad = $request->capacidad;
        $property->habitaciones = $request->habitaciones;
        $property->baños = $request->banios;
        $property->garages = $request->garages;

        $property->save();

        // Check if a profile image has been uploaded
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
            // Set user profile image path in database to filePath
            $property->image_path = $filePath;
        }
        // Persist user record to database
        $property->save();

        // Message
        $request->session()->flash('alert-success', 'Propiedad creada exitosamente!');

        // Return user back and show a flash message
        return redirect('admin/dashboard/create-property')->with('alert-success', 'Propiedad creada exitosamente!');
    }
}