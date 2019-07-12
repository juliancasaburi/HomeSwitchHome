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

use App\Hotsale;

Route::get('/', 'HomeController@index');

Route::get('contact', function () {
    $hotsales = Hotsale::where('deleted_at', null)->get();
    return view('contact')->with('hotsales', $hotsales);
});

Route::get('faq', function () {
    $hotsales = Hotsale::where('deleted_at', null)->get();
    return view('faq')->with('hotsales', $hotsales);
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

    // Admin Account
    Route::get('/modify-data', 'AdminController@showModifyData')->name('admin.showModifyData');
    Route::put('/modify-data', 'AdminController@modifyData')->name('admin.modifyData');

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
    Route::post('/dashboard/delete-week', 'AdminController@deleteWeek')->name("admin.deleteWeek");
    Route::post('/dashboard/hotsale-week', 'AdminController@hotsaleWeek')->name("admin.hotsaleWeek");
    Route::get('/dashboard/week-list', 'AdminController@showWeekList')->name('admin.weekList');
    Route::get('/dashboard/week-info', 'AdminController@showWeekInfo')->name('admin.weekInfo');
    Route::get('/dashboard/inscription-list', 'AdminController@showInscriptionList')->name('admin.inscriptionList');
    Route::post('/dashboard/delete-auction', 'AdminController@deleteAuction')->name("admin.deleteAuction");
    Route::post('/dashboard/modify-week', 'AdminController@modifyWeek')->name("admin.modifyWeek");
    Route::get('/dashboard/auctions-inscription-period', 'AdminController@showAuctionsInscriptionPeriod')->name('admin.auctionInscriptionPeriod');
    Route::get('/dashboard/comments/{property}', 'AdminController@propertyComments')->name('admin.comments');
    Route::get('/dashboard/hotsale-list', 'AdminController@showHotsaleList')->name('admin.hotsaleList');
    Route::post('/dashboard/delete-hotsale', 'AdminController@deleteHotsale')->name('admin.deleteHotsale');
    Route::post('/dashboard/modify-hotsale', 'AdminController@modifyHotsale')->name('admin.modifyHotsale');
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

Route::post('/createComment', 'CommentController@store')->name("comments.store");

/*
|--------------------------------------------------------------------------
| Week Routes
|--------------------------------------------------------------------------
*/
Route::get('/week', 'WeekController@index');
Route::get('/hotsale-week', 'WeekController@showHotsaleWeek');
Route::get('locations/get', 'WeekController@getLocations');
Route::get('/weeks', 'WeekController@showGrid');
Route::post('/week', 'WeekController@book')->name('week.premiumBooking');


/*
|--------------------------------------------------------------------------
| Hotsale Routes
|--------------------------------------------------------------------------
*/

Route::get('/hotsales', 'HotsaleController@index');
//
