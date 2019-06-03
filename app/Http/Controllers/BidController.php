<?php

namespace App\Http\Controllers;

use App\InscriptionForFutureAuction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Auction;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Bid;


class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        if (User::where('id', $request->userID)->first()->creditos == 0) {
            return redirect()->back()->with('alert-error', 'No tienes créditos');
        }

        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            // Redirect back and show an error flash message
            return redirect()->back()->withErrors($validator);
        }

        $auction = Auction::where('id', $request->auctionID)->first();

        if($request->amount < $auction->precio_inicial){
            return redirect()->back()->with('alert-error', 'El monto debe superar al precio inicial');
        }

        if (!$auction->bids->isEmpty() && $request->amount < $auction->latestBid->first()->monto) {
                return redirect()->back()->with('alert-error', 'El monto debe superar al de la última puja');
        }

        // Place bid
        $bid = new Bid();
        $bid->usuario_id = $request->userID;
        $bid->subasta_id = $request->auctionID;
        $bid->monto = $request->amount;
        $bid->save();
        // Redirect back and flash success message
        return redirect()->back()->with('alert-success', 'Puja exitosa');
    }
}
