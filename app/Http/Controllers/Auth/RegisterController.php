<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use App\Price;
use App\User;
use App\Card;
use App\Property;
use App\Week;
use App\Hotsale;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $normalUserSubscriptionPrice = Price::price('Subscripción usuario normal');
        $availableHotsales = Hotsale::active()->count();

        $registerView = view('auth.register', [
            'normalUserSubscriptionPrice' => $normalUserSubscriptionPrice,
            'availableHotsales' => $availableHotsales,
        ]);

        $property = Property::inRandomOrder()->first();
        if($property){
            $weeks = $property->weeks()->whereHas('activeAuction', function ($query) {
                $query->whereNull('deleted_at')->where('inscripcion_fin', '>=', Carbon::now());
            })->count();
            $registerView->with(
                [
                    'p' => $property,
                    'weeks' => $weeks,
                ]
            );
        }

        $week = Week::has('activeAuction')->inRandomOrder()->first();
        if($week){
            $registerView->with('w', $week);
        }

        return $registerView;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'fecha_nacimiento.before' => 'Debes ser mayor de 18 años de edad.',
        ];
        return Validator::make($data, [
            'apellido' => ['required', 'string', 'max:40'],
            'nombre' => ['required', 'string', 'max:40'],
            'pais' => ['required'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:usuarios'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'fecha_nacimiento' => ['required', 'date', 'before:-18 years'],
            'DNI' => ['required', 'string', 'unique:usuarios'],
            'numero_tarjeta' => ['required', 'string', 'min:16', 'max:16'],
            'marca' => ['required'],
            'nombre_titular' => ['required', 'string', 'max:80'],
            'fecha_vencimiento' => ['required'],
            'cvv' => ['required', 'min:3', 'max:3'],
            'acceptTOS' => ['accepted'],
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration and register their card
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $newUser = User::create([
            'email' => $data['email'],
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'pais' => $data['pais'],
            'DNI' => $data['DNI'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'password' => Hash::make($data['password']),
        ]);

        // Create and save user's card
        $userCard = new Card();
        $userCard->usuario_id = $newUser->id;
        $userCard->numero = $data['numero_tarjeta'];
        $userCard->marca = $data['marca'];
        $userCard->nombre_titular = $data['nombre_titular'];
        $userCard->fecha_vencimiento = $data['fecha_vencimiento'];
        $userCard->codigo_verificacion = $data['cvv'];
        $userCard->save();

        return $newUser;
    }
}
