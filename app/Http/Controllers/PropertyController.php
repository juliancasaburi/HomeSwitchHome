<?php

namespace App\Http\Controllers;

use App\Auction;
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
        $weeks = $property->activeWeeks()->whereHas('auction', function ($query) {
            $query->where('inscripcion_inicio', '<=', Carbon::now())
            ->where('inscripcion_fin', '>', Carbon::now());
        })->get();

         // Return view
        return view('property', [
            'property' => $property,
            'weeks' => $weeks,
        ]);
    }

    /**
     * Show the property grid.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGrid()
    {
        $properties = Property::has('weeks')->orderBy('nombre', 'asc')->paginate(2);
        $weeks = array();
        foreach($properties as $p){
            array_push($weeks, $p->weeks()->whereHas('auction', function ($query) {
                $query->where('inscripcion_fin', '>=', Carbon::now());
            })->count());
        }
        return view('properties', [
            'properties' => $properties,
            'weeks' => $weeks,
        ]);
    }

    public function showPropertiesOfASpecificDay(Request $request){
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
            //Day is Monday

            $properties = Property::whereHas('weeks', function ($query) use ($request) {
                $query->where('fecha', "=", $request->fecha)->where('deleted_at', '=', null)->whereHas('auction', function ($query) {
                    $query->where('inscripcion_fin', '>=', Carbon::now());
                });
            })->orderBy('nombre', 'asc')->paginate(2);

            $weeks = array();
            foreach($properties as $p){
                array_push($weeks, $p->weeks()->count());
            }

            return view('properties', [
                'properties' => $properties,
                'weeks' => $weeks,
            ]);
        }
        else {
            // Day is not Monday
            // Redirect back and flash error message
            return redirect('/');
        }
    }


}
