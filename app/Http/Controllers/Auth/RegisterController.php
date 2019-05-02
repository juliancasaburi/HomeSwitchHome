<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'apellido' => ['required', 'string', 'max:255'],
            'nombre' => ['required', 'string', 'max:255'],
            'nacionalidad' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'fecha_nacimiento' => ['required'],
            'DNI' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'activa' => 1,
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'email_verified_at' => null,
            'password' => Hash::make($data['password']),
            'creditos' => 2,
            'saldo' => 0.0,
            'tarjeta_credito' => null,
            'tarjeta_debito' => null,
            'verificado' => 0,
            'nacionalidad' => $data['nacionalidad'],
            'DNI' => $data['DNI'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'fecha_registro' => now(),
            'premium' => 0,
        ]);
    }
}
