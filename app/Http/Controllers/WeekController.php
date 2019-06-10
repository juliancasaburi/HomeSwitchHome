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
        if(empty($week)) {
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

        $weeks = Week::whereBetween('fecha', [$fromWeekStart, $toWeekStart ])
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
}