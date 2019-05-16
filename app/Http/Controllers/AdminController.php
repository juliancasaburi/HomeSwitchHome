<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Property;
use App\Auction;

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
        return view('admin-dashboard')->with(
            [
                'usersCount' => User::all()->count(),
                'premiumUsersCount' => User::where('premium', 1)->count(),
                'propertiesCount' => Property::all()->count(),
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
        return view('admin-create-property');
    }

    /**
     * Show the User list.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserList()
    {
        $users = User::all();
        return view('admin-user-list')->with ('users',$users);
    }

    public function showPropertyList()
    {
        $properties = Property::all();
        return view('admin-property-list')->with ('properties',$properties);
    }

    public function showWeekCreationForm(){
        $properties = Property::all();
        return view('admin-create-week')->with('properties', $properties);
    }

    public function editUser(Request $request){
        $userHasBeenModified = false;
        $validator = Validator::make($request->all(), [
            'saldo' => ['numeric'],
            'creditos' => ['numeric'],
        ]);

        if($validator->fails()){
            // Return admin back and show an error flash message
            return redirect('admin/dashboard/user-list')->withErrors($validator);
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
            return redirect('admin/dashboard/user-list')->with('alert-success', 'Usuario modificado');
        }
        return redirect('admin/dashboard/user-list')->with('alert-warning', 'Los datos no cambiaron');
    }

    public function showAuctionList()
    {
        $auctions = Auction::all();
        return view('admin-auction-list')->with ('auctions',$auctions);
    }
}
