<?php

namespace App\Http\Controllers;

use App\Hotsale;
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
        $enabled = ((!$week->trashed()) && ($reservation->isEmpty()) && ($week->activeAuction->inscripcion_inicio <= Carbon::now()) && ($week->activeAuction->inscripcion_fin > Carbon::now()));

        $availableHotsales = Hotsale::all()->count();

        // Return view
        return view('week', [
            'week' => $week,
            'enabled' => $enabled,
            'availableHotsales' => $availableHotsales,
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
            ->whereHas('activeAuction', function ($query) {
                $query->where('inscripcion_inicio', '<=', Carbon::now())->where('inscripcion_fin', '>', Carbon::now());
            })
            ->paginate(2)
            ->withPath('?searchLocalidad='.$request->searchLocalidad.'&semanaDesde='.$fromWeekStart.'&semanaHasta='.$toWeekStart);

        $availableHotsales = Hotsale::all()->count();

        return view('weeks', [
            'weeks' => $weeks,
            'availableHotsales' => $availableHotsales,
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

        $locations = $locations->unique('localidad');

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
            if(($week) && (!$week->reservation) && ($week->activeAuction->inscripcion_inicio <= Carbon::now()) && ($week->activeAuction->inscripcion_fin > Carbon::now())){

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

    public function hotsaleBook(Request $request)
    {
        $user = Auth::user();
        $week = Week::find($request->weekID);

        if(($week) && ($week->activeHotsale) && (!$week->reservation) && ($user->saldo >= $week->activeHotsale->precio)) {

            $week->hotsaleBookTo($user);

            // Redirect back and show a success message
            return redirect()
                ->back()
                ->with('alert-success', 'Adquirida');

        }
        else {
            // Redirect back and show an error message
            return redirect()
                ->back()
                ->with('alert-error', 'Operacion inválida');
        }
    }
}