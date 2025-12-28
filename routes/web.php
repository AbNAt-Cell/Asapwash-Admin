<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return view('customer-landing');
    }
});

// DO NOT DELETE FOLLOWING CODE UNLESS YOUR DO NOT NEED THE SUPPORT FROM SAASMONKS
if (env('ENABLE_DIRECT_ADMIN_LOGIN') == true) {
    Route::post('/direct-login', function () {
        $user = \App\User::where('id', 1)->first();
        if ($user) {
            Auth::login($user);
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'Invalid User');
    })->name('direct-login');
}

Auth::routes();

// DO NOT UNCOMMENT OR DELETE FOLLOWING CODE UNLESS YOUR DO NOT NEED THE SUPPORT FROM SAASMONKS
// if (env('APP_DEBUG')) {
//     Route::get('/direct-login', function () {
//         $user = \App\User::where('id', 1)->first();
//         if ($user) {
//             Auth::login($user);
//             return redirect()->route('home');
//         }
//         return redirect()->back()->with('error', 'Invalid User');
//     })->name('direct-login');
// }

Route::post('/active', 'Admin\AdminSettingController@active')->middleware('web');
Route::post('/saveAdminData', 'Admin\AdminSettingController@setup')->name('saveAdminData');

// Data Deletion Request Routes (Public)
Route::get('/data-deletion', 'DataDeletionController@index')->name('data-deletion.index');
Route::post('/data-deletion', 'DataDeletionController@store')->name('data-deletion.store');

// Privacy Policy (Public)
Route::get('/privacy', 'DataDeletionController@privacyPolicy')->name('privacy-policy');

// Route::get('/wpTesting', 'Admin\TwilioController@index');
Route::get('/paypal', 'AppHelper@paypaln');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'Admin\PaymentTransactionController@dashboard')->name('home');
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group(['middleware' => ['auth']], function () {

    Route::group(['namespace' => 'Admin'], function () {

        Route::resources([
            'roles' => 'RolesController',
            'users' => 'UsersController',
            'categories' => 'CategoryController',
            'vehicleBrand' => 'VehicleBrandController',
            'vehicleModel' => 'VehicleModelController',
            'notification' => 'StaticNotiController',
            'faq' => 'FAQController',

        ]);
        Route::get('privacy-policy', 'AdminSettingController@pp')->name('pp');
        Route::post('pp/update', 'AdminSettingController@updatePP')->name('pp.update');
        // module
        Route::post('twilio/update', 'TwilioController@updateTwilio')->name('twilio.update');
        Route::post('onesignal', 'StaticNotiController@updateOnesignl')->name('onesignal.update');
        Route::post('base', 'AdminSettingController@updateBase')->name('base.update');
        Route::post('stripe', 'StripeController@updateStripe')->name('stripe.update');
        Route::post('paypal', 'StripeController@updatePaypal')->name('paypal.update');
        Route::post('razor', 'StripeController@updateRazor')->name('razor.update');
        // module
        Route::get('setting', 'AdminSettingController@index')->name('setting.index');
        Route::post('setting/basic', 'AdminSettingController@basicUpdate')->name('setting.basic');
        Route::get('custom/notification', 'StaticNotiController@customIndex')->name('custom.index');
        Route::post('custom/notification/user', 'StaticNotiController@customUser')->name('custom.user');

        Route::get('earning', 'PaymentTransactionController@index')->name('earning.index');
        Route::post('earning', 'PaymentTransactionController@index')->name('earning.filter');
        Route::post('earning/show', 'PaymentTransactionController@show')->name('earning.show');
        Route::post('earning/settle', 'PaymentTransactionController@settle')->name('earning.settle');

    });
    Route::get('appuser', 'AppUsersController@index')->name('appuser.index');
    Route::post('appuser/status/{id}', 'AppUsersController@changeStatus')->name('appuser.statusChange');
    Route::get('shopowner', 'ShopOwner\ShopOwnerController@index')->name('shopowner.index');
    Route::get('shopowner/{id}', 'ShopOwner\ShopOwnerController@show')->name('shopowner.show');
    Route::get('shopowner/{id}/detail', 'ShopOwner\ShopOwnerController@shopDetail')->name('shopowner.detail');
    Route::post('shopowner/status/{id}', 'ShopOwner\ShopOwnerController@changeStatus')->name('shopowner.statusChange');
    Route::post('shopowner/popular/{id}', 'ShopOwner\ShopOwnerController@changePopular')->name('shopowner.popularChange');
    Route::post('shopowner/best/{id}', 'ShopOwner\ShopOwnerController@changeBest')->name('shopowner.bestChange');
});
