<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
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

    const PROPERTYURL = 'property?id=';
    const WEEKURL = 'week?id=';
    const AUCTIONURL = 'auction?id=';

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
        $properties = Property::orderBy('nombre', 'asc')->get();
        return view('admin.admin-property-list',
            [
                'properties' => $properties,
                'propertyURL' => self::PROPERTYURL,
            ]
        );
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
            // Show an error flash message
            foreach($validator->errors() as $e){
                Session::flash('error', $e);
                return View::make('partials/flash-messages');
            }
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
            // show a success flash message
            Session::flash('success', 'Usuario '. $user->id.' modificado');
            return View::make('partials/flash-messages');
        }
        else{
            // show a success flash message
            Session::flash('warning', 'Usuario '. $user->id.' no modificado');
            return View::make('partials/flash-messages');
        }
    }

    public function showAuctionList()
    {
        $auctions = Auction::withTrashed()->get();
        return view('admin.admin-auction-list',
            [
                'auctions' => $auctions,
                'auctionURL' => self::AUCTIONURL,
                'propertyURL' => self::PROPERTYURL,
                'weekURL' => self::WEEKURL,
            ]
        );
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
        return view('admin.admin-reservation-list',
            [
                'reservations' => $reservations,
                'propertyURL' => self::PROPERTYURL,
                'weekURL' => self::WEEKURL,
            ]
        );
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
        return view('admin/admin-active-auction-list',
            [
                'auctions' => $auctions,
                'auctionURL' => self::AUCTIONURL,
                'propertyURL' => self::PROPERTYURL,
                'weekURL' => self::WEEKURL,
            ]
        );
    }

    public function showAuctionsInscriptionPeriod(){
        $auctions = Auction::where('inscripcion_inicio', '<=', Carbon::now())->where('inscripcion_fin', '>=', Carbon::now())->get();
        return view('admin/admin-auction-inscription-period-list',
            [
                'auctions' => $auctions,
                'auctionURL' => self::AUCTIONURL,
                'propertyURL' => self::PROPERTYURL,
                'weekURL' => self::WEEKURL,
            ]
        );
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
        return View::make('partials/flash-messages');
    }

    public function demoteUser(Request $request)
    {
        $user = User::find($request->id);
        $user->premium = 0;
        $user->save();

        Session::flash('success', 'Usuario degradado a Básico');
        return View::make('partials/flash-messages');
    }

    public function deleteProperty(Request $request){
        $property = Property::find($request->id);

        $propertyWeeks = $property->weeks()->get();

        //Property doesn't have weeks
        if($propertyWeeks->isEmpty()){
            //Property doesn't have weeks
            $property->forceDelete();

        }
        //Property has weeks
        else{
            $hasNotAuctionsInParticipationPeriod = true;
            foreach($propertyWeeks as $week){
                if($week->activeAuction && $week->activeAuction->inicio <= Carbon::now() && $week->activeAuction->fin >= Carbon::now()){
                    $hasNotAuctionsInParticipationPeriod = false;
                }
            }
            if($hasNotAuctionsInParticipationPeriod){
                foreach($propertyWeeks as $week){
                    $weekActiveAuction = $week->activeAuction;
                    if ($weekActiveAuction && $weekActiveAuction->inscripcion_inicio > Carbon::now()){
                        $weekActiveAuction->delete();
                    }
                    elseif ($weekActiveAuction && $weekActiveAuction->inicio > Carbon::now()){
                        $weekActiveAuction->delete();
                        $weekActiveAuction->sendAuctionCancelledNotifications();
                    }
                    $week->delete();
                }
                $property->delete();
                return back()->with('alert-success', 'Propiedad '. $property->nombre. ' eliminada');
            }
            else{
                return back()->with('alert-danger', 'La propiedad tiene subastas activas!');
            }
        }
    }

    function deleteWeek(Request $request){
        $week = Week::find($request->id);
        $weekActiveAuction = $week->activeAuction;
        if ($weekActiveAuction && $weekActiveAuction->inscripcion_inicio > Carbon::now()){
            $weekActiveAuction->delete();
            $week->delete();
        }
        elseif ($weekActiveAuction && $weekActiveAuction->inicio > Carbon::now()){
            $weekActiveAuction->delete();
            $week->delete();
            $weekActiveAuction->sendAuctionCancelledNotifications();
        }
        elseif ($weekActiveAuction && $weekActiveAuction->inicio <= Carbon::now() && $weekActiveAuction->fin >= Carbon::now()){
            return back()->with('alert-danger', 'La semana está en período de subasta');
        }
        else{
            $week->delete();
        }
        return back()->with('alert-success', 'Semana eliminada!');
    }

    function showWeekList(){

        $weeks = Week::all();

        return view('admin/admin-week-list',
            [
                'weeks' => $weeks,
                'propertyURL' => self::PROPERTYURL,
            ]
        );
    }

    public function showWeekInfo(Request $request)
    {
        $week = Week::find($request->id);
        return view('admin.admin-week-info',
            [
                'week' => $week,
                'propertyURL' => self::PROPERTYURL,
            ]
        );
    }

    public function deleteAuction(Request $request){

        $auction = Auction::find($request->id);

        if($auction->inscripcion_inicio > Carbon::now()){
            $auction->forceDelete();
            return back()->with('alert-success', 'Subasta eliminada!');
        }
        else if($auction->inicio >= Carbon::now()){
            return back()->with('alert-danger', 'La subasta ya ha comenzado!');
        }

        return back()->with('alert-success', 'Subasta cancelada!');
    }

    public function modifyWeek(Request $request){
        $validator = Validator::make($request->all(), [
            'fecha_nueva' => ['required', 'date',
                Rule::unique('semanas', 'fecha')->where(function ($query) use ($request){
                    return $query->where('fecha', $request->fecha_nueva)
                                 ->where('deleted_at', null);
                })]
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        else{
            $formDate = strtotime($request->fecha_nueva);

            $dayOfWeek = date("l", $formDate);
            // Is it monday?
            if($dayOfWeek  == 'Monday') {

                $week = Week::find($request->id);

                if($week->activeAuction->isInBiddingPeriod()){
                    return redirect()->back()->withErrors(['subasta' => ['Esta semana tiene una subasta en periodo de participación!']]);
                }
                else{
                    $week->update(['fecha' => $request->fecha_nueva]);
                    return redirect()->back()->with('alert-success', 'Semana modificada exitosamente!');
                }
            }
            else {
                // Day is not Monday
                return redirect()->back()->withErrors(['fecha' => ['El día de la fecha elegida no es lunes!']]);
            }
        }


    }

    /**
     * Show the inscription list
     *
     * @return \Illuminate\Http\Response
     */
    public function showInscriptionList()
    {
        $inscriptions = InscriptionForFutureAuction::all();
        return view('admin.admin-inscription-list')->with ('inscriptions',$inscriptions);
    }

    /**
     * Show the modify account details form
     *
     * @return \Illuminate\Http\Response
     */
    public function showModifyData()
    {
        return view('admin.admin-modify-data');
    }

    public function modifyData()
    {
        $rules = [
            'nombre' => 'required|max:40',
            'apellido' => 'required|max:40',
            'newEmail' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:8',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $admin = Auth::user();
        $admin->nombre = Input::get('nombre');
        $admin->apellido = Input::get('apellido');
        $admin->email = Input::get('newEmail');
        $admin->password = bcrypt(Input::get('password'));
        $admin->save();

        return redirect()->back()->with('alert-success', 'Tus datos fueron modificados exitosamente!');
    }

}
