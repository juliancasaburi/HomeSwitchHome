<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use App\User;

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
        return view('admin-users-list')->with ('users',$users);
    }

    public function showPropertyList()
    {
        $properties = Property::all();
        return view('admin-properties-list')->with ('properties',$properties);
    }

    public function showWeekCreationForm(){
        $properties = Property::all();
        return view('admin-create-week')->with('properties', $properties);
    }
}
