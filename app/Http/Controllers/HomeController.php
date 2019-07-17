<?php

namespace App\Http\Controllers;

use App\Hotsale;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Property;
use App\Price;

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

        $weeks = array();
        foreach($properties as $p){
            array_push($weeks, $p->weeks()->whereHas('activeAuction', function ($query) {
                $query->whereNull('deleted_at')->where('inscripcion_fin', '>=', Carbon::now());
            })->count());
        }

        $availableHotsales = Hotsale::where('fecha_inicio', '<=', Carbon::now())->where('fecha_fin', '>=', Carbon::now())->count();

         // Return view
        return view('index', [
            'properties' => $properties,
            'weeks' => $weeks,
            'availableHotsales' => $availableHotsales,
            'normalUserSubscriptionPrice' => Price::price('Subscripcion usuario normal'),
            'premiumPlusPrice' => Price::price('Plus usuario premium'),
        ]);
    }
}
