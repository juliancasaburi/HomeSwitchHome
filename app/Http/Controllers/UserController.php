<?php

namespace App\Http\Controllers;

use App\Hotsale;
use Illuminate\Support\Facades\Validator;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Price;
use App\Reservation;
use App\InscriptionForFutureAuction;
use App\Bid;

class UserController extends Controller
{

    const PROPERTYURL = 'property?id=';
    const WEEKURL = 'week?id=';
    const AUCTIONURL = 'auction?id=';

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
        $userID = Auth::user()->id;
        $inscriptions = InscriptionForFutureAuction::where('usuario_id', $userID)->get();
        $bids = Bid::where('usuario_id', $userID)->get();
        $reservations = Reservation::where('usuario_id', $userID)->get();
        $activities = $inscriptions
            ->concat($bids)
            ->concat($reservations);
        $activities = $activities->sortByDesc('created_at');

        $availableHotsales = Hotsale::active()->count();

        return view('user.user-profile')->with(
            [
                'propertyURL' => self::PROPERTYURL,
                'weekURL' => self::WEEKURL,
                'activities' => $activities,
                'premiumPlusPrice' => Price::price('Plus usuario premium'),
                'normalUserSubscriptionPrice' => Price::price('Subscripcion usuario normal'),
                'availableHotsales' => $availableHotsales,
            ]
        );
    }

    public function showEmailForm()
    {
        $availableHotsales = Hotsale::active()->count();
        return view('user.user-email-form')->with('availableHotsales', $availableHotsales);
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
        $availableHotsales = Hotsale::active()->count();
        return view('user.user-password-form')->with('availableHotsales', $availableHotsales);
    }

    public function showModifyDataForm()
    {
        $availableHotsales = Hotsale::active()->count();
        return view('user.user-modify-data')->with('availableHotsales', $availableHotsales);
    }

    public function modifyData()
    {
        $rules = [
            'nombre' => 'required|min:2|max:40',
            'apellido' => 'required|min:2|max:40',
            'pais' => 'required',
            'fecha_nacimiento' => 'required|date|before:-18 years',
        ];
        $messages = [
            'fecha_nacimiento.before' => 'Debes ser mayor de 18 años de edad.',
        ];
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $usuario = Auth::user();
        $usuario->nombre = Input::get('nombre');
        $usuario->apellido = Input::get('apellido');
        $usuario->pais = Input::get('pais');
        $usuario->fecha_nacimiento = Input::get('fecha_nacimiento');
        $usuario->save();

        return redirect()->back()->with('alert-success', 'Tus datos fueron modificados exitosamente!');
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
                return redirect('/profile/modify-password')->with('alert-error', 'Contraseña actual incorrecta');
            }
        }
    }

    public function showInscriptionList()
    {
        $inscriptions = Auth::user()->auctionInscriptions->sortByDesc('created_at');
        $availableHotsales = Hotsale::active()->count();
        return view('user.user-inscription-list',
            [
                'inscriptions' => $inscriptions,
                'auctionURL' => self::AUCTIONURL,
                'propertyURL' => self::PROPERTYURL,
                'availableHotsales' => $availableHotsales,
            ]
        );
    }

    public function showBidList()
    {
        $bids = Auth::user()->bids->sortByDesc('created_at');
        $availableHotsales = Hotsale::active()->count();

        return view('user.user-bid-list',
            [
                'bids' => $bids,
                'auctionURL' => self::AUCTIONURL,
                'propertyURL' => self::PROPERTYURL,
                'availableHotsales' => $availableHotsales,
            ]
        );
    }

    public function showReservations(){

        $reservations = Auth::user()->reservationsWithTrashed->sortByDesc('created_at');

        $availableHotsales = Hotsale::active()->count();

        return view('user.user-reservation-list',
            [
                'reservations' => $reservations,
                'auctionURL' => self::AUCTIONURL,
                'propertyURL' => self::PROPERTYURL,
                'weekURL' => self::WEEKURL,
                'availableHotsales' => $availableHotsales,
            ]
        );
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

    public function cancelReservation()
    {
        $reservation = Reservation::find(Input::get('reservationID'));
        $user = Auth::User();
        // Validate Reservation
        if($reservation->usuario_id == $user->id) {
            // Cancel Reservation
            $reservation->cancel();

            $date = Carbon::now();
            if($date->diffInMonths($reservation->week->fecha) >= 1){
                $balance = 0.0;
                if($reservation->modo_reserva != 1) {
                    $balance = $reservation->valor_reservado;
                    $user->saldo += $balance;
                }
                $user->creditos += 1;
                $user->save();
                // Return back and show a success message
                return redirect()->back()
                    ->with('alert-success-title', 'Reserva ' . Input::get('reservationID') . ' cancelada ')
                    ->with('alert-success', 'Te acreditamos 1 crédito y $' . $balance);
            }
            else{
                return redirect()->back()
                    ->with('alert-success-title', 'Reserva ' . Input::get('reservationID') . ' cancelada ')
                    ->with('alert-success', '');
            }
        }
        else{
            // Return back and show an error message
            return redirect()->back()
                ->with('alert-error', 'Operacion inválida');
        }

    }

    public function showModifyPaymentDetailsForm(){
        $availableHotsales = Hotsale::active()->count();
        return view('user.user-modify-payment-details')->with('availableHotsales', $availableHotsales);
    }

    public function modifyPaymentDetails(){
        $rules = [
            'password' => 'required',
            'numero_tarjeta' => 'required|min:16|max:16',
            'marca' => 'required|max:50',
            'nombre_titular' => 'required|max:80',
            'fecha_vencimiento' => 'required|date',
            'cvv' => 'required|min:3|max:3',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        else{
            $user = Auth::user();
            if (Hash::check(Input::get('password'), $user->password)){
                $userCard = $user->card;
                $userCard->numero = Input::get('numero_tarjeta');
                $userCard->marca = Input::get('marca');
                $userCard->nombre_titular = Input::get('nombre_titular');
                $userCard->fecha_vencimiento = Input::get('fecha_vencimiento');
                $userCard->codigo_verificacion = Input::get('cvv');
                $userCard->save();
                $user->sendPaymentDetailsChangedNotification();
                return redirect()->back()->with('alert-success', 'Datos de pago modificados exitosamente!');
            }
            else
            {
                return redirect()->back()->with('alert-error', 'Contraseña incorrecta')->withErrors([
                    'password' => 'Contraseña incorrecta',
                ]);
            }
        }
    }

    public function downgradeMembership(){
        $user = Auth::user();
        $user->premium = 0;
        $user->save();

        // Return back and show a success message
        return redirect()
            ->back()
            ->with('alert-success', 'Membresía Premium Cancelada. Ahora eres Usuario Básico');
    }
}
