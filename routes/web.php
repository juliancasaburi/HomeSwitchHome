<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes(['verify' => true]);

Route::get('/profile', 'UserController@showUserProfile');

Route::get('logout', function() {
    return Redirect::to("/");
});

Route::post('logout', function() {
    Auth::logout();
    Session::flush();
    Session::regenerate();
    return Redirect::to("/");
});

Route::prefix('admin')->group(function() {
    Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/dashboard/create-property', 'AdminController@showPropertyCreationForm')->name('admin.createProperty');
    Route::post('/dashboard/create-property', 'PropertyCreationController@store')->name('property.create');
    Route::get('/dashboard/user-list', 'AdminController@showUserList')->name('admin.userList');
});

//
