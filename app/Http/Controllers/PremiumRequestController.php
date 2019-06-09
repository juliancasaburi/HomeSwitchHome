<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Price;
use App\PremiumRequest;

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

        $premiumConcept = Price::where('concepto', '=', 'Plus usuario premium')->first();
        $user = Auth::user();

        if($user->saldo >= $premiumConcept->valor){
            // Create a PremiumRequest
            $premiumRequest = new PremiumRequest();
            $premiumRequest->usuario_id = $user->id;
            $premiumRequest->valor = $premiumConcept->valor;
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

    public function delete()
    {
        $user = Auth::user();
        $premiumRequest = $user->premiumRequest;

        $user->saldo += $premiumRequest->valor;
        $user->save();
        $premiumRequest->delete();

        // Redirect back and flash success message
        return redirect()
            ->back()
            ->with('alert-success', 'Solicitud cancelada. Te devolvimos $'. $premiumRequest->valor);
    }
}
