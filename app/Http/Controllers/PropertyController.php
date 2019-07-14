<?php

namespace App\Http\Controllers;

use App\Hotsale;
use Illuminate\Http\Request;
use App\Property;
use App\Week;
use Carbon\Carbon;

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

        // If property id doesn't exist, show 404 error page
        if(empty($property)) {
            abort(404);
        }

        // Property exists, pass only those weeks where the auctions are in registration period.
        $weeks = $property->activeWeeks()->whereHas('activeAuction', function ($query) {
            $query->where('inscripcion_inicio', '<=', Carbon::now())
            ->where('inscripcion_fin', '>', Carbon::now());
        })->get();

        $availableHotsales = Hotsale::all()->count();

         // Return view
        return view('property', [
            'property' => $property,
            'weeks' => $weeks,
            'availableHotsales' => $availableHotsales,
        ]);
    }

    /**
     * Show the property grid.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGrid()
    {
        $properties = Property::whereHas('weeks', function ($query) {
            $query->whereNull('deleted_at');
        })->orderBy('nombre', 'asc')->paginate(2);
        $weeks = array();
        foreach($properties as $p){
            array_push($weeks, $p->weeks()->whereHas('activeAuction', function ($query) {
                $query->whereNull('deleted_at')->where('inscripcion_fin', '>=', Carbon::now());
            })->count());
        }

        $availableHotsales = Hotsale::all()->count();

        return view('properties', [
            'properties' => $properties,
            'weeks' => $weeks,
            'availableHotsales' => $availableHotsales,
        ]);
    }
}
