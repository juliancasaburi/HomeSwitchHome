<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Auction;
use App\InscriptionForFutureAuction;

class InscriptionForFutureAuctionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // Validate credits
        if($user->creditos == 0){
            // Return user back and show an error message
            return redirect()
                ->back()
                ->with('alert-error', 'No tienes créditos');
        }

        // Validate Auction
        $auction = Auction::find($request->auid);
        $dateTime = Carbon::now();
        if(($auction) && ($auction->inscripcion_inicio) <= $dateTime && ($auction->inscripcion_fin > $dateTime)){

            // Create & save a new Inscription
            $inscription = new InscriptionForFutureAuction();
            $inscription->subasta_id = $request->auid;
            $inscription->usuario_id = $user->id;

            $inscription->save();

            // Return user back and show a flash message
            return redirect()
                ->back()
                ->with('alert-success', 'Inscripcion exitosa!');

        }
        else{
            // Return user back and show an error message
            return redirect()
                ->back()
                ->with('alert-error', 'Operacion inválida');
        }
    }
}