<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Reservation;
use App\Week;

class WeekController extends Controller
{

    /**
     * Show a week.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $week = Week::where('id', $request->id)
            ->withTrashed()
            ->get()
            ->first();

        // If property id doesn't exist, show 404 error page
        if(empty($week)) {
            abort(404);
        }

        $reservation = Reservation::where('semana_id', $week->id)->get();
        $enabled = ((!$week->trashed()) && ($reservation->isEmpty()) && ($week->auction->inscripcion_inicio <= Carbon::now()) && ($week->auction->inscripcion_fin > Carbon::now()));

        // Return view
        return view('week', [
            'week' => $week,
            'enabled' => $enabled,
        ]);
    }

    /**
     * Show the week grid.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGrid(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'searchLocalidad' => ['required', 'string'],
            'semanaDesde' => ['required', 'date'],
            'semanaHasta' => ['required', 'date'],
        ]);

        if($validator->fails()){
            // Redirect to home
            return redirect('/');
        }
        $fromWeekStart = Carbon::parse($request->semanaDesde)
            ->startOfWeek()
            ->toDateString();

        $toWeekStart = Carbon::parse($request->semanaHasta)
            ->startOfWeek()
            ->toDateString();

        $weeks = Week::whereHas('property', function($q) use($request) {
            $q->where('localidad', $request->searchLocalidad);
        })
            ->whereBetween('fecha', [$fromWeekStart, $toWeekStart ])
            ->whereNull('deleted_at')
            ->whereHas('auction', function ($query) {
                $query->where('inscripcion_inicio', '<=', Carbon::now())->where('inscripcion_fin', '>', Carbon::now());
            })
            ->paginate(2)
            ->withPath('?semanaDesde='.$fromWeekStart.'&semanaHasta='.$toWeekStart);

        return view('weeks', [
            'weeks' => $weeks,
        ]);
    }

    public function getLocations() {
        $locations = DB::table('semanas')
            ->join('subastas', function ($join) {
                $join->on('semanas.id', '=', 'subastas.semana_id')
                    ->whereNull('subastas.deleted_at');
            })
            ->join('propiedades', function ($join) {
                $join->on('semanas.propiedad_id', '=', 'propiedades.id')
                    ->whereNull('propiedades.deleted_at');
            })
            ->whereNull('semanas.deleted_at')
            ->get();


        return json_encode($locations->pluck('localidad'));

    }

    public function book(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();
        if(!$user->premium){
            // Redirect back and show an error message
            return redirect()
                ->back()
                ->with('alert-error', 'Operacion inválida');
        }
        else{
            $week = Week::find($request->weekID);
            if(($week) && (!$week->reservation) && ($week->auction->inscripcion_inicio <= Carbon::now()) && ($week->auction->inscripcion_fin > Carbon::now())){

                $week->bookTo($user);

                // Redirect back and show a success message
                return redirect()
                    ->back()
                    ->with('alert-success', 'Adjudicada');

            }
            else{
                // Redirect back and show an error message
                return redirect()
                    ->back()
                    ->with('alert-error', 'Operacion inválida');
            }
        }
    }
}