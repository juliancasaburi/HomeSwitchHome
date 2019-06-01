<?php

namespace App\Http\Controllers;

use App\User;
use App\Price;
use App\PremiumRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PremiumRequestController extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'userID.unique' => 'Ya tienes una solicitud en espera de aprobación',
        ];

        $validator = Validator::make($request->all(), [
            'userID' => ['exists:usuarios,id', 'unique:solicitudes_premium,usuario_id'],
        ], $messages);


        if($validator->fails()){
            // Redirect back and show an error flash message
            return redirect('/profile')
                ->withErrors($validator);
        }

        $user = User::find($request->userID);
        $premiumConcept = Price::where('concepto', '=', 'Plus usuario premium')->first();

        if($user->saldo >= $premiumConcept->valor){
            // Create a PremiumRequest
            $premiumRequest = new PremiumRequest();
            $premiumRequest->usuario_id = $user->id;
            $premiumRequest->save();
            $user->saldo -= $premiumConcept->valor;
            $user->save();

            // Redirect back and flash success message
            return redirect('/profile')
                ->with('alert-success', 'Solicitud realizada exitosamente.');
        }
        else {
            // Redirect back and flash error message
            return redirect('/profile')
                ->with('alert-error', 'Tu saldo es menor a '.$premiumConcept->valor);
        }
    }
}
