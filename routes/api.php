<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'employee'], function () {
    Route::post('forgot', 'AppUsersController@forgot');
    Route::post('forgot/validate', 'AppUsersController@forgotValidate');
    Route::get('noti/setting', 'Admin\AdminSettingController@apiNotiKey');
    Route::group(['namespace' => 'ShopOwner'], function () {
        Route::get('home', 'OwnerShopController@homeIndexEmp');
        Route::post('login', 'ShopEmployeeController@login');
    });

    Route::group(['middleware' => ['auth:shopEmployee']], function () {
        Route::post('profile/update', 'AppUsersController@profileUpdate');
        Route::post('booking/{id}/complete', 'BookingMasterController@completeBooking');
        Route::get('booking/{id}/toggle-payment-status', 'BookingMasterController@toggleOfflinePaymentStatus');
        Route::post('profile/password/update', 'AppUsersController@password');
        Route::post('profile/picture/update', 'AppUsersController@profilePictureUpdate');
        Route::post('newpassword', 'AppUsersController@newPassword');
        Route::post('storeDeviceToken', 'AppUsersController@storeDeviceToken');

        Route::get('profile', function (Request $request) {
            return response()->json(['success' => true,'data'=>$request->user()]);
        });
        Route::post('storeDeviceToken', 'AppUsersController@storeDeviceToken');
        Route::group(['namespace' => 'ShopOwner'], function () {
            Route::get('notification', 'ShopEmployeeController@notification');

            Route::get('review', 'ShopEmployeeController@employeeReview');
            Route::get('booking', 'ShopEmployeeController@booking');
            Route::get('booking/{id}', 'ShopEmployeeController@singleBooking');
            Route::post('booking', 'ShopEmployeeController@bookingFilleter');
        });
    });

    Route::get('apiConnectionTest' , function(){
        return response()->json(['success' => true,'message'=>'API connection successful'], 200);
    });
});

Route::group(['prefix' => 'owner'], function () {
    // shopOwner
    // namespace App\Http\Controllers\Admin;
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('noti/setting', 'AdminSettingController@apiNotiKey');
        Route::get('category', 'CategoryController@apiIndex');
    });
    Route::get('booking/{id}/toggle-payment-status', 'BookingMasterController@toggleOfflinePaymentStatus')->middleware(['auth:shopOwner']);
    Route::group(['namespace' => 'ShopOwner'], function () {
        Route::group(['middleware' => ['auth:shopOwner']], function () {
            Route::get('notification', 'OwnerShopController@notification');

            Route::get('waiting/booking', 'OwnerShopController@waitingBooking');
            Route::get('booking', 'OwnerShopController@allBooking');
            Route::get('home', 'OwnerShopController@homeIndex');
            Route::get('shop/booking/{id}', 'OwnerShopController@shopBooking');

            Route::get('booking/{id}', 'ShopEmployeeController@singleBooking');
            Route::post('booking/{id}/approved', 'ShopEmployeeController@approvedBooking');
            Route::resources([
                'service' => 'SubCategoriesController',
                'employee' => 'ShopEmployeeController',
                'shop' => 'OwnerShopController',
                'package' => 'PackageController',
            ]);
            Route::get('/shop_id/{id}','OwnerShopController@singleShop');
        });
        Route::post('register', 'ShopOwnerController@store');
        Route::post('login', 'ShopOwnerController@login');
      
    });
    Route::group(['middleware' => ['auth:shopOwner']], function () {
        Route::post('profile/update', 'AppUsersController@profileUpdate');
        Route::post('profile/password/update', 'AppUsersController@password');
        Route::post('profile/picture/update', 'AppUsersController@profilePictureUpdate');
        Route::post('newpassword', 'AppUsersController@newPassword');
        Route::post('storeDeviceToken', 'AppUsersController@storeDeviceToken');

        Route::get('profile', function (Request $request) {
            return response()->json(['data'=>$request->user(),'success'=>true]);
        });
    });
    Route::post('verifyMe', 'AppUsersController@verifyMe');
    Route::post('forgot', 'AppUsersController@forgot');
    Route::post('forgot/validate', 'AppUsersController@forgotValidate');
    Route::get('privacy', 'AppUsersController@privacy');

    Route::get('apiConnectionTest' , function(){
        return response()->json(['success' => true,'message'=>'API connection successful'], 200);
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('payment/setting', 'AdminSettingController@apiPaymentData');
        Route::get('noti/setting', 'AdminSettingController@apiNotiKey');
        Route::get('vehicleBrand', 'VehicleBrandController@apiIndex');
        Route::get('vehicleModel/{brand}', 'VehicleBrandController@getBrandModel');
    });
    Route::group(['middleware' => ['auth:appUser']], function () {
        Route::post('vehicle', 'AppUsersController@newVehicleStore');
        Route::get('vehicle', 'AppUsersController@vehicleList');
        Route::get('vehicle/{id}', 'AppUsersController@singleVehicle');
        Route::post('address', 'AppUsersController@newAddressStore');
        Route::get('address', 'AppUsersController@addressList');
        Route::get('delete-address/{id}', 'AppUsersController@deleteAddress');
        Route::post('booking', 'BookingMasterController@store');
        Route::get('simpleState', 'AppUsersController@simpleState');
        Route::get('notification', 'AppUsersController@notification');
        Route::post('profile/update', 'AppUsersController@profileUpdate');
        Route::post('profile/password/update', 'AppUsersController@password');
        Route::post('profile/picture/update', 'AppUsersController@profilePictureUpdate');
        Route::get('profile', function (Request $request) {
            return response()->json(['success' => true,'data'=>$request->user()]);

        });
        Route::post('storeDeviceToken', 'AppUsersController@storeDeviceToken');
        Route::get('booking', 'BookingMasterController@userBooking');
        Route::get('booking/{id}', 'BookingMasterController@singleBooking');
        Route::post('booking/{id}/payment', 'BookingMasterController@completePayment');
        Route::post('review', 'BookingMasterController@reviewStore');
    });
    Route::group(['namespace' => 'ShopOwner'], function () {
        Route::get('shop/{id}', 'OwnerShopController@singleShop');
        Route::get('category/{id}', 'OwnerShopController@shopByCategory');
        Route::get('shop', 'OwnerShopController@allShop');
        Route::get('package/{id}', 'OwnerShopController@packageSingle');
        Route::get('shop/{id}/service/{catid}', 'OwnerShopController@shopServiceByCate');
        Route::post('storeDeviceToken', 'AppUsersController@storeDeviceToken');
    });
    Route::get('privacy', 'AppUsersController@privacy');
    Route::get('faq', 'AppUsersController@faqList');
    Route::get('home', 'AppUsersController@homeApi');
    Route::post('register', 'AppUsersController@store');
    Route::post('verifyMe', 'AppUsersController@verifyMe');
    Route::post('login', 'AppUsersController@login');
    Route::post('forgot', 'AppUsersController@forgot');
    Route::post('forgot/validate', 'AppUsersController@forgotValidate');
    Route::post('newpassword', 'AppUsersController@newPassword');

    Route::get('apiConnectionTest' , function(){
        return response()->json(['success' => true,'message'=>'API connection successful'], 200);
    });
});
