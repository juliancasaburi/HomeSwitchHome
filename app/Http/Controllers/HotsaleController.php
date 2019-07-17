<?php

namespace App\Http\Controllers;

use App\Hotsale;
use App\Reservation;
use App\Week;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotsaleController extends Controller
{
    public function index(){

        $hotsales = Hotsale::where('fecha_inicio', '<=', Carbon::now())->where('fecha_fin', '>=', Carbon::now())->paginate(2);
        $availableHotsales = Hotsale::where('fecha_inicio', '<=', Carbon::now())->where('fecha_fin', '>=', Carbon::now())->count();
        return view('hotsales', [
            'hotsales' => $hotsales,
            'availableHotsales' => $availableHotsales,
        ]);
    }

    public function showHotsaleWeek(Request $request)
    {

        $hotsale = Hotsale::where('id', $request->id)
            ->withTrashed()
            ->get()
            ->first();


        // If property id doesn't exist, show 404 error page
        if(empty($hotsale)) {
            abort(404);
        }

        $week = Week::where('id', $hotsale->semana_id)
            ->withTrashed()
            ->get()
            ->first();

        $reservation = Reservation::where('semana_id', $week->id)->get();
        $enabled = ((!$week->trashed()) && (!$hotsale->trashed()) && ($reservation->isEmpty()));

        $availableHotsales = Hotsale::where('fecha_inicio', '<=', Carbon::now())->where('fecha_fin', '>=', Carbon::now())->count();

        // Return view
        return view('hotsaleWeek', [
            'week' => $week,
            'enabled' => $enabled,
            'hotsale' => $hotsale,
            'availableHotsales' => $availableHotsales,
        ]);
    }
}
