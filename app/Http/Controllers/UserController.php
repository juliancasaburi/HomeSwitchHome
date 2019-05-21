<?php

namespace App\Http\Controllers;

use App\InscriptionForFutureAuction;
use App\Property;
use App\Reservation;
use App\User;
use App\Week;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\CurrentPassword;
use App\Bid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/');
    }

    public function showUserProfile()
    {
        return view('user-profile');
    }

    public function showEmailForm()
    {
        return view('user-email-form');
    }

    public function modifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required',new CurrentPassword()],
            'newEmail' => 'required|email|unique:usuarios,email',
        ]);

        if($validator->fails()){
            // Return user back and show an error flash message
            return redirect('/profile/modify-email')->withErrors($validator);
        }

        $usuario = User::find($request->actualEmail);
        $usuario->email = $request->newEmail;
        $usuario->save();

        return redirect('/profile/modify-email')->with('alert-success', 'Tu email se ha modificado exitosamente!');
    }

    public function showInscriptionList()
    {
        $inscriptions = Auth::user()->auctionInscriptions;
        return view('user-inscription-list')->with ('inscriptions',$inscriptions);
    }

    public function showBidList()
    {
        $bids = Auth::user()->bids;
        return view('user-bid-list')->with ('bids',$bids);
    }

    public function showPastReservations(){

        $reservations = Auth::user()->reservations;

        return view('user-past-reservations')->with('reservations', $reservations);
    }

    public function addBalance()
    {
        // validate
        $rules = array(
            'amount'       => ['required', 'numeric', 'min:1'],
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        } else {
            // store
            $user = Auth::user();
            $user->saldo += Input::get('amount');
            $user->save();

            // redirect
            return redirect()->back()->with('alert-success', '$'.Input::get('amount').' fueron cargados en tu cuenta!');
        }
    }
}
