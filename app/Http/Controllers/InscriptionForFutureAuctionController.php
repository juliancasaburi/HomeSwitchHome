<?php

namespace App\Http\Controllers;

use App\InscriptionForFutureAuction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class InscriptionForFutureAuctionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        if(User::find($request->uid)->first()->creditos == 0){
            // Return user back and show a flash message
            return redirect()->back()->with('alert-error', 'No tienes créditos');
        }

        $inscription = new InscriptionForFutureAuction();
        $inscription->subasta_id = $request->auid;
        $inscription->usuario_id = $request->uid;

        $inscription->save();

        // Return user back and show a flash message
        return redirect()->back()->with('alert-success', 'Inscripcion exitosa!');
    }
}