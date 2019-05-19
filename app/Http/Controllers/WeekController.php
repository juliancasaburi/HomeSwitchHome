<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Week;
use Carbon\Carbon;

class WeekController extends Controller
{

    /**
     * Show the property list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $week = Week::where('id', Request()->id)
            ->get()->first();

        // If property id doesn't exist, show 404 error page
        if(empty($week)) {
            abort(404);
        }

        // Return view
        return view('week', [
            'week' => $week,
        ]);
    }

    /**
     * Show the property grid.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGrid()
    {
        $weeks = Week::join('subastas', 'semanas.id', '=', 'subastas.semana_id')->orderBy('inscripcion_inicio', 'asc')->paginate(2);
        return view('weeks', [
            'weeks' => $weeks,
        ]);
    }
}