<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuctionController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auction = Auction::where('id', Request()->id)
            ->withTrashed()
            ->get()
            ->first();

        // If auction id doesn't exist, show 404 error page
        if(empty($auction)) {
            abort(404);
        }

        $latestBid = $auction->latestBid;

        $enabled = ($auction->inicio <= Carbon::now() && $auction->fin > Carbon::now() && !$auction->trashed());

        $availableHotsales = Hotsale::active()->count();

        if(Auth::user()) {
            $myLatestBid = $auction->latestBidForUser(Auth::user())->first();
            // Return view
            return view('auction', [
                'availableHotsales' => $availableHotsales,
                'auction' => $auction,
                'latestBid' => $latestBid,
                'enabled' => $enabled,
                'myLatestBid' => $myLatestBid,
            ]);
        }

        // Return view
        return view('auction', [
            'availableHotsales' => $availableHotsales,
            'auction' => $auction,
            'latestBid' => $latestBid,
            'enabled' => $enabled,
        ]);
    }
}
