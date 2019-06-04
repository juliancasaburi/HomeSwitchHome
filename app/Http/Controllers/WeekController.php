<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Week;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

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
        if(empty($week) || !$week->auction) {
            abort(404);
        }

        // Return view
        return view('week', [
            'week' => $week,
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
            'fecha' => ['required', 'date'],
        ]);

        if($validator->fails()){
            // Redirect to home
            return redirect('/');
        }

        $weekStart = Carbon::parse($request->fecha)
            ->startOfWeek()
            ->toDateString();

        $weeks = Week::where('fecha', '=', $weekStart)
            ->whereNull('deleted_at')
            ->whereHas('auction', function ($query) {
                $query->where('inscripcion_inicio', '<=', Carbon::now())->where('inscripcion_fin', '>', Carbon::now());
            })
            ->paginate(2)
            ->withPath('?fecha='.$weekStart);

        return view('weeks', [
            'weeks' => $weeks,
        ]);
    }
}