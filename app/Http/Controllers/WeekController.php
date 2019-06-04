<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Week;
use Carbon\Carbon;

class WeekController extends Controller
{

    /**
     * Show a week.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $week = Week::where('id', Request()->id)
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
    public function showGrid()
    {
        $weeks = Week::has('auction')->paginate(2);
        return view('weeks', [
            'weeks' => $weeks,
        ]);
    }
}