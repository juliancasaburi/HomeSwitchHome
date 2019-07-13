<?php

namespace App\Http\Controllers;

use App\Hotsale;
use App\Week;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotsaleController extends Controller
{
    public function index(){

        $hotsales = Hotsale::paginate(2);

        return view('hotsales', [
            'hotsales' => $hotsales,
        ]);
    }
}
