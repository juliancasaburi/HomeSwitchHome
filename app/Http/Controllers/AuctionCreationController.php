<?php

namespace App\Http\Controllers;

use App\InscriptionForFutureAuction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Auction;
use Illuminate\Support\Facades\DB;
use App\Week;

class AuctionCreationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.admin.createAuction');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idPropiedad' => ['required', 'numeric'],
            'inscripcionFechaApertura' => ['required', 'date'],
            'inscripcionFechaCierre' => ['required', 'date'],
            'subastaFechaApertura' => ['required', 'date'],
            'subastaFechaCierre' => ['required', 'date'],
            'precioInicial' => ['required', 'numeric', 'gte:0'],
        ]);

        if($request->inscripcionFechaCierre <= $request->inscripcionFechaApertura){
            // Redirect back and flash error message
            return redirect()
                ->back()
                ->withInput($request->all())
                ->with('alert-error', 'Fecha finaliza Inscripcion debe ser mayor a Fecha comienzo Inscripcion');
        }

        if($request->subastaFechaApertura <= $request->inscripcionFechaCierre){
            // Redirect back and flash error message
            return redirect()
                ->back()
                ->withInput($request->all())
                ->with('alert-error', 'Fecha comienzo Subasta debe ser mayor a Fecha finaliza Inscripcion');
        }

        if($request->subastaFechaCierre <= $request->subastaFechaAperura){
            // Redirect back and flash error message
            return redirect()
                ->back()
                ->withInput($request->all())
                ->with('alert-error', 'Fecha finaliza Subasta debe ser mayor a Fecha comienzo Subasta');
        }

        if($validator->fails()){
            // Redirect back and show an error flash message
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        // Week already exists?
        $week = Week::where('propiedad_id', $request->idPropiedad)
            ->where('fecha', $request->semana)
            ->first();
        if (Auction::where('semana_id', $week->id)->count() == 0) {
            // Create Auction and save it to DB
            $auction = new Auction();
            $auction->semana_id = $week->id;
            $auction->precio_inicial = $request->precioInicial;
            $auction->inscripcion_inicio = $request->inscripcionFechaApertura;
            $auction->inscripcion_fin = $request->inscripcionFechaCierre;
            $auction->inicio = $request->subastaFechaApertura;
            $auction->fin = $request->subastaFechaCierre;
            $auction->save();
            // Redirect back and flash success message
            return redirect('admin/dashboard/create-auction')->with('alert-success', 'Subasta creada exitosamente!');
        }
        return redirect()
            ->back()
            ->withInput($request->all())
            ->with('alert-error', 'Ya existe una subasta para esta semana');
    }

public function getWeeks($id) {
    $weeks = DB::table("semanas")->where("propiedad_id",$id)->pluck("fecha");
    return json_encode($weeks);

}
}
