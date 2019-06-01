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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
        return view('user.user-profile')->with(
            [
                'premiumUserSubscriptionPrice' => DB::table('precios')->where('concepto', 'Subscripcion usuario normal')->pluck('valor')->first(),
                'normalUserSubscriptionPrice' => DB::table('precios')->where('concepto', 'Subscripcion usuario normal')->pluck('valor')->first(),
            ]
        );
    }

    public function showEmailForm()
    {
        return view('user.user-email-form');
    }

    public function modifyEmail()
    {
        $validator = Validator::make(Input::all(), [
            'password' => ['required',new CurrentPassword()],
            'newEmail' => 'required|email|unique:usuarios,email',
        ]);

        if($validator->fails()){
            // Return user back and show an error flash message
            return redirect('/profile/modify-email')->withErrors($validator);
        }

        $usuario = Auth::user();
        $usuario->email = Input::get('newEmail');
        $usuario->save();
        $usuario->sendEmailChangedNotification();

        return redirect('/profile/modify-email')->with('alert-success', 'Tu email se ha modificado exitosamente!');
    }

    public function showPasswordForm(){
        return view('user.user-password-form');
    }

    public function modifyPassword(){
        $rules = [
            'mypassword' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
        $messages = [
            'mypassword.required' => 'El campo es requerido',
            'password.required' => 'El campo es requerido',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'El minimo permitido son 8 caracteres',
        ];
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()){
            return redirect('/profile/modify-password')->withErrors($validator);
        }
        else{
            if (Hash::check(Input::get('mypassword'), Auth::user()->password)){
                $user = Auth::user();
                $user->password = bcrypt(Input::get('password'));
                $user->save();
                return redirect('/profile')->with('alert-success', 'Contraseña cambiada exitosamente');
            }
            else
            {
                return redirect('/profile/modify-password')->with('alert-success', 'Datos incorrectos');
            }
        }
    }

    public function showInscriptionList()
    {
        $inscriptions = Auth::user()->auctionInscriptions;
        return view('user.user-inscription-list')->with ('inscriptions',$inscriptions);
    }

    public function showBidList()
    {
        $bids = Auth::user()->bids;
        return view('user.user-bid-list')->with ('bids',$bids);
    }

    public function showReservations(){

        $reservations = Auth::user()->reservationsWithTrashed;

        return view('user.user-reservation-list')->with('reservations', $reservations);
    }

    public function addBalance()
    {
        // validate
        $rules = array(
            'amount'       => ['required', 'numeric', 'min:1'],
            'fecha_caducidad_tarjeta' => ['required'],
            'cvv_tarjeta' => ['required', 'min:3', 'max:3'],
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

    public function cancelReservation()
    {
        $reservation = Reservation::find(Input::get('reservationID'));
        $balance = $reservation->valor_reservado;
        $reservation->cancel();
        return redirect()->back()
            ->with('alert-success-title', 'Reserva '.Input::get('reservationID').' cancelada ')
            ->with('alert-success', 'Te acreditamos 1 crédito y $'.$balance);

    }

    public function showModifyPaymentDetailsForm(){
        return view('user.user-modify-payment-details');
    }

    public function modifyPaymentDetails(){
        $rules = [
            'password' => 'required',
            'numeroTarjeta' => 'required|min:16|max:16',
            'fechaCaducidadTarjeta' => 'required|date',
            'cvvTarjeta' => 'required|min:3|max:3',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        else{
            if (Hash::check(Input::get('password'), Auth::user()->password)){
                $user = Auth::user();
                $user->numero_tarjeta = Input::get('numeroTarjeta');
                $user->save();
                return redirect()->back()->with('alert-success', 'Datos de pago modificados exitosamente!');
            }
            else
            {
                return redirect()->back()->with('alert-error', 'Contraseña incorrecta');
            }
        }
    }
}
