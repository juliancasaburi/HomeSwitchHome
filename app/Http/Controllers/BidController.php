<?php

namespace App\Http\Controllers;

use App\InscriptionForFutureAuction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Auction;
use App\Bid;


class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // Validate auction
        $user = Auth::user();
        if ($user->creditos == 0) {
            // User doesn't have credits
            return redirect() // Redirect back and show an error message
                ->back()
                ->with('alert-error', 'No tienes créditos');
        }
        $inscription = InscriptionForFutureAuction::where('subasta_id', $request->auctionID)->where('usuario_id', $user->id)->get();
        if ($inscription) {
            // Validate bid Amount
            $validator = Validator::make($request->all(), [
                'amount' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                // Redirect back and show an error message
                return redirect()
                    ->back()
                    ->withErrors($validator);
            }

            $auction = Auction::find($request->auctionID);

            if ($request->amount < $auction->precio_inicial) {
                // Redirect back and show a success message
                return redirect()
                    ->back()
                    ->with('alert-error', 'El monto debe superar al precio inicial');
            }

            if (!$auction->bids->isEmpty() && $request->amount < $auction->latestBid->first()->monto) {
                // Redirect back and show a success message
                return redirect()
                    ->back()
                    ->with('alert-error', 'El monto debe superar al de la última puja');
            }

            // Place bid
            $bid = new Bid();
            $bid->usuario_id = $user->id;
            $bid->subasta_id = $request->auctionID;
            $bid->monto = $request->amount;
            $bid->save();

            // Redirect back and show a success message
            return redirect()
                ->back()
                ->with('alert-success', 'Puja exitosa');
        }
        else{
            // Redirect back and show an error message
            return redirect()
                ->back()
                ->with('alert-error', 'Operacion inválida');

        }
    }
}
