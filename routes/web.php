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

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'HomeController@index');

Route::get('contact', function () {
    return view('contact');
});

Route::get('faq', function () {
    return view('faq');
});

//--------- User Auth ---------
Auth::routes(['verify' => true]);

Route::get('logout', function() {
    return Redirect::to("/");
});

//----------------------------------------------

//--------- Authenticated Users routes ---------

Route::post('logout', function() {
    Auth::logout();
    Session::flush();
    Session::regenerate();
    return Redirect::to("/");
});

// Profile
Route::get('/profile', 'UserController@showUserProfile')->middleware('verified');

//--- Profile Actions ---

Route::put('/add-balance', 'UserController@addBalance');

Route::post('/request-premium', 'PremiumRequestController@store');

Route::delete('/cancel-premium-request', 'PremiumRequestController@delete');

Route::post('/downgrade-membership', 'UserController@downgradeMembership');

//-----------------------

// Modify email
Route::get('/profile/modify-email', 'UserController@showEmailForm')->middleware('verified');
Route::put('/profile/modify-email', 'UserController@modifyEmail')->name('user.modifyEmail');

// Modify password
Route::get('/profile/modify-password', 'UserController@showPasswordForm')->middleware('verified');
Route::put('/profile/modify-password', 'UserController@modifyPassword');

// Modify payment details
Route::get('/profile/modify-payment-details', 'UserController@showModifyPaymentDetailsForm')->middleware('verified');
Route::put('/profile/modify-payment-details', 'UserController@modifyPaymentDetails')->name('user.modifyPaymentDetails');

// Modify data
Route::get('/profile/modify-data', 'UserController@showModifyDataForm')->middleware('verified');
Route::put('/profile/modify-data', 'UserController@modifyData')->name('user.modifyData');

// Inscriptions
Route::get('/profile/inscription-list', 'UserController@showInscriptionList')->name('user.inscriptionList')->middleware('verified');

// Bids
Route::get('/profile/bid-list', 'UserController@showBidList')->name('user.bidList')->middleware('verified');

// Auctions
Route::get('/auction', function() {
    return view('auction');
});

//Reservations
Route::get('/profile/reservation-list', 'UserController@showReservations')->name('user.reservations')->middleware('verified');
Route::put('/profile/reservation-list', 'UserController@cancelReservation')->name('user.cancelReservation');
//----------------------------------------------

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function() {
    //---------------- Admin Auth ----------------
    Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    //--------------------------------------------

    //---------------- Dashboard -----------------
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/dashboard/create-property', 'AdminController@showPropertyCreationForm')->name('admin.createProperty');
    Route::post('/dashboard/create-property', 'PropertyCreationController@store')->name('property.create');
    Route::get('/dashboard/user-list', 'AdminController@showUserList')->name('admin.userList');
    Route::get('/dashboard/user-info', 'AdminController@showUserInfo')->name('admin.userInfo');
    Route::put('/dashboard/edit-user', 'AdminController@editUser')->name('admin.editUser');
    Route::get('/dashboard/property-list', 'AdminController@showPropertyList')->name('admin.propertyList');
    Route::get('/dashboard/create-week', 'AdminController@showWeekCreationForm')->name('admin.createWeek');
    Route::post('/dashboard/create-week', 'WeekCreationController@store')->name('week.create');
    Route::get('/dashboard/auction-list', 'AdminController@showAuctionList')->name('admin.propertyList');
    Route::get('/dashboard/create-auction', 'AdminController@showAuctionCreationForm')->name('admin.createAuction');
    Route::post('/dashboard/create-auction', 'AuctionCreationController@store')->name('auction.create');
    Route::get('/dashboard/reservation-list', 'AdminController@showReservationList')->name('admin.reservationList');
    Route::put('/dashboard/reservation-list', 'AdminController@cancelReservation')->name('admin.cancelReservation');
    Route::get('/dashboard/prices', 'AdminController@showUpdatePriceForm')->name('admin.updatePrices');
    Route::put('/dashboard/prices', 'AdminController@updatePrice')->name('admin.updatePrice');
    Route::get('/dashboard/active-auctions', 'AdminController@showActiveAuctions')->name('admin.activeAuction');
    Route::get('/dashboard/premium-request-list', 'AdminController@showPremiumRequestList')->name('admin.premiumRequestList');
    Route::delete('/dashboard/premium-request-accept', 'AdminController@acceptPremiumRequest')->name('admin.premiumRequestAccept');
    Route::delete('/dashboard/premium-request-reject', 'AdminController@rejectPremiumRequest')->name('admin.premiumRequestReject');
    Route::post('/dashboard/promote-user', 'AdminController@promoteUser')->name('admin.promoteUser');
    Route::post('/dashboard/demote-user', 'AdminController@demoteUser')->name('admin.demoteUser');
    Route::post('/dashboard/delete-property', 'AdminController@deleteProperty')->name("admin.deleteProperty");
    Route::get('/dashboard/weeks-list', 'AdminController@showWeeksList')->name('admin.weeksList');
    //--------------------------------------------
});

/*
|--------------------------------------------------------------------------
| Auction Routes
|--------------------------------------------------------------------------
*/

// Auction creation helper
Route::get('weeks/get/{id}', 'AuctionCreationController@getWeeks');

// Auction inscription
Route::post('/auctionSignin', 'InscriptionForFutureAuctionController@store')->name('auction.signIn');

// Auction
Route::get('/auction', 'AuctionController@index');
Route::post('/auction/bid', 'BidController@store');

/*
|--------------------------------------------------------------------------
| Property Routes
|--------------------------------------------------------------------------
*/

Route::get('/property', 'PropertyController@index');
Route::get('/properties', 'PropertyController@showGrid');

/*
|--------------------------------------------------------------------------
| Week Routes
|--------------------------------------------------------------------------
*/
Route::get('/week', 'WeekController@index');
Route::get('/weeks', 'WeekController@showGrid');

//
