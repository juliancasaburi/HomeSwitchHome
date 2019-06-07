<?php

namespace App\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\User;
use App\Property;
use App\Auction;
use App\Week;
use App\InscriptionForFutureAuction;
use App\Reservation;
use App\Price;
use App\PremiumRequest;
use App\Bid;

class AdminController extends Controller
{

    protected function guard(){
        return Auth::guard('auth:admin');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin-dashboard')->with(
            [
                'userCount' => User::all()->count(),
                'premiumUserCount' => User::premium()->count(),
                'normalUserSubscriptionPrice' => Price::price('Subscripcion usuario normal'),
                'premiumPlusPrice' => Price::price('Plus usuario premium'),
                'propertyCount' => Property::all()->count(),
                'weekCount' => Week::all()->count(),
                'pendingAuctionCount' => Auction::pending()->count(),
                'inscriptionAuctionCount' => Auction::awaitingInscriptionPeriod()->count(),
                'activeAuctionCount' => Auction::active()->count(),
                'inscriptionCount' => InscriptionForFutureAuction::all()->count(),
                'bidCount' => Bid::all()->count(),
            ]
        );
    }

    /**
     * Show the Property Creation Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPropertyCreationForm()
    {
        return view('admin.admin-create-property');
    }

    /**
     * Show the User list.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserList()
    {
        // Return users ordered by created_at in descending order (latest first)
        $users = User::latest()->get();
        return view('admin.admin-user-list')->with ('users',$users);
    }

    /**
     * Show all data for a single user.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserInfo(Request $request)
    {
        $user = User::find($request->id);
        return view('admin.admin-user-info')->with ('user',$user);
    }

    public function showPropertyList()
    {
        $properties = Property::all();
        return view('admin.admin-property-list')->with ('properties',$properties);
    }

    public function showWeekCreationForm(){
        $properties = Property::all();
        return view('admin.admin-create-week')->with('properties', $properties);
    }

    public function editUser(Request $request){
        $userHasBeenModified = false;
        $validator = Validator::make($request->all(), [
            'saldo' => ['numeric'],
            'creditos' => ['numeric'],
        ]);

        if($validator->fails()){
            // Return admin back and show an error flash message
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $user = User::find($request->userID);
        if ($request->userCreditos != $user->creditos) {
            $user->creditos = $request->userCreditos;
            $userHasBeenModified = true;
        }
        if ($request->userSaldo != $user->saldo) {
            $user->saldo = $request->userSaldo;
            $userHasBeenModified = true;
        }
        if ($userHasBeenModified) {
            $user->save();
            // Return user back and show a flash message
            return redirect()
                ->back()
                ->with('alert-success', 'Usuario modificado');
        }
        return redirect()
            ->back()
            ->with('alert-warning', 'Los datos no cambiaron');
    }

    public function showAuctionList()
    {
        $auctions = Auction::withTrashed()->get();
        return view('admin.admin-auction-list')->with ('auctions',$auctions);
    }

    public function showAuctionCreationForm(){
        return view('admin.admin-create-auction', [
            'properties' => Property::all(),
            'weeks' => Week::all(),
        ]);
    }

    public function showReservationList()
    {
        $reservations = Reservation::withTrashed()->get();
        return view('admin.admin-reservation-list')->with ('reservations',$reservations);
    }

    public function cancelReservation()
    {
        $reservation = Reservation::find(Input::get('reservationID'));
        $reservation->cancel();
        return redirect()->back()->with('alert-success', 'Reserva '.Input::get('reservationID').' cancelada');

    }

    public function showUpdatePriceForm(){
        $concepts = Price::all();
        return view('admin.admin-prices')->with('concepts', $concepts);
    }

    public function updatePrice(){
        $validator = Validator::make(Input::all(), [
            'price' => ['required', 'numeric', 'gte:0'],
        ]);

        if($validator->fails()){
            // Return admin back and show an error flash message
            return redirect()->back()->withErrors($validator);
        }

        $price = Price::find(Input::get('idConcept'));
        $price->valor = Input::get('price');
        $price->save();

        return redirect()
            ->back()
            ->with('alert-success', $price->concepto.' establecido en $'.Input::get('price'));
    }

    public function showActiveAuctions(){
        $auctions = Auction::where('inicio', '<=', Carbon::now())->where('fin', '>=', Carbon::now())->get();
        return view('admin/admin-active-auction-list')->with('auctions',$auctions);
    }

    /**
     * Show the premium request list
     *
     * @return \Illuminate\Http\Response
     */
    public function showPremiumRequestList()
    {
        $requests = PremiumRequest::all();
        return view('admin.admin-premium-request-list')->with ('requests',$requests);
    }

    public function acceptPremiumRequest(Request $request)
    {
        $premiumRequest = PremiumRequest::find($request->requestID);

        $user = User::find($request->userID);
        $user->premium = true;
        $user->save();
        $user->sendPremiumAcceptedNotification(Carbon::now());
        $premiumRequest->delete();

        // Redirect back and flash success message
        return redirect()
            ->back()
            ->with('alert-success', 'Solicitud aceptada para el usuario '. $user->nombre. ' '. $user->apellido);
    }

    public function rejectPremiumRequest(Request $request)
    {
        $premiumRequest = PremiumRequest::find($request->requestID);

        $user = User::find($request->userID);
        $user->saldo += $premiumRequest->valor;
        $user->save();
        $user->sendPremiumRejectedNotification(Carbon::now());
        $premiumRequest->delete();

        // Redirect back and flash success message
        return redirect()
            ->back()
            ->with('alert-success', 'Solicitud rechazada para el usuario '. $user->nombre. ' '. $user->apellido);
    }

    public function promoteUser(Request $request)
    {
        $user = User::find($request->id);
        $user->premium = 1;
        $user->save();

        Session::flash('success', 'Usuario promovido a Premium');
        return View::make('layouts/partials/flash-messages');
    }

    public function demoteUser(Request $request)
    {
        $user = User::find($request->id);
        $user->premium = 0;
        $user->save();

        Session::flash('success', 'Usuario degradado a Básico');
        return View::make('layouts/partials/flash-messages');
    }

    public function deleteProperty(Request $request){
        $property = Property::find($request->idPropiedad);

        if(($property->weeks()->get()->isEmpty())){
            //Property doesn't have weeks
            $property->forceDelete();

        }
        else if($property->weeks()->has('auction')->get()->isEmpty()){
            //Property has weeks but these don't have auctions
            $property->weeks()->forceDelete();
            $property->forceDelete();
        }
        else{
            //Property has weeks and some of these have auctions (deleted or not)
            //Notify users about what happened

            /*CODE*/

            $property->delete();

        }

        return back();
    }
}
