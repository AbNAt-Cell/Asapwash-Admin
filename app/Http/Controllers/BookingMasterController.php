<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use App\BookingMaster;
use App\Http\Controllers\Admin\CoderController;
use App\Http\Controllers\Admin\StaticNotiController;
use App\Http\Controllers\Admin\StripeController;
use App\PaymentTransaction;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use LicenseBoxAPI;

class BookingMasterController extends Controller
{
    //
    public function store(Request $request)
    {
        // BookingMaster
        $request->validate([
            'shop_id' => 'bail|required',
            'owner_id' => 'bail|required',
            'address' => 'bail|required',
            'start_time' => 'bail|required',
            'end_time' => 'bail|required',
            'vehicle_id' => 'bail|required',
            'service_type' => 'bail|required',
            'amount' => 'bail|required',
            'discount' => 'bail|required',
            'payment_status' => 'bail|required',
            'payment_method' => 'bail|required',
            'status' => 'bail|required',
            'service' => 'bail|required',
        ]);
        $reqData = $request->all();
        $reqData['user_id'] = Auth::id();
        $reqData['admin_per'] = AdminSetting::first()->admin_per;

        $reqData['booking_id'] = substr(uniqid(), 0, 10); 
        $data = BookingMaster::create($reqData);

        $ids['user_id'] = $data['user_id'];
        $ids['shop_id'] = $data['shop_id'];
        $ids['owner_id'] = $data['owner_id'];
        $ids['start_time'] = $data['start_time'];
        $ids['bid'] = $data['id'];
        $ids['booking_id'] = $data['booking_id'];
        $ids['employee_id'] = $data['employee_id'];
        $ids['address'] = $data['address'];
        try {
            $res = (new Admin\StaticNotiController)->baseNotification($ids, 2);
        } catch (\Exception $e) {
            info($e);
        }

        return response()->json(['msg' => 'Your Booking is arrived , wait  for confirmation', 'data' => null, 'success' => true], 200);
    }

    public function userBooking()
    {
     
        $master['wait'] = BookingMaster::with(['shop:id,name', 'model:id,reg_number'])->where([['user_id', Auth::id()], ['status', 0]])->get(['id', 'start_time', 'end_time', 'status', 'address', 'shop_id', 'vehicle_id', 'booking_id']);
        $master['current'] = BookingMaster::with(['shop:id,name', 'model:id,reg_number'])->where([['user_id', Auth::id()], ['status', 1]])->get(['id', 'start_time', 'end_time', 'status', 'address', 'shop_id', 'vehicle_id', 'booking_id']);
        $master['complete'] = BookingMaster::with(['shop:id,name', 'model:id,reg_number'])->where([['user_id', Auth::id()], ['status', 2]])->get(['id', 'start_time', 'end_time', 'status', 'address', 'shop_id', 'vehicle_id', 'booking_id']);
        $master['cancel'] = BookingMaster::with(['shop:id,name', 'model:id,reg_number'])->where([['user_id', Auth::id()], ['status', '!=', 1], ['status', '!=', 0], ['status', '!=', 2]])->get(['id', 'start_time', 'end_time', 'status', 'address', 'shop_id', 'vehicle_id', 'booking_id']);
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }
    public function singleBooking($id)
    {
        $master = BookingMaster::with(['shop:id,name,image,address', 'model.model.brand', 'review'])->where('id', $id)->get()->first()->setAppends(['serviceData', 'currency']);
        return response()->json(['msg' => null, 'data' => $master, 'success' => true], 200);
    }
    public function reviewStore(Request $request)
    {
        $coder = new CoderController;
        if (method_exists($coder, 'realityCheck')) {
            $coder->realityCheck();
        } else {
            Artisan::call('down');
            abort(503);
        }
        $request->validate([
            'shop_id' => 'bail|required',
            'employee_id' => 'bail|required',
            'booking_id' => 'bail|required',
            'star' => 'bail|required|numeric|min:1|max:5',
        ]);
        $reqData = $request->all();
        $reqData['user_id'] = Auth::user()->id;
       $data =  Review::create($reqData);
        return response()->json(['msg' => 'Thanks for review', 'data' => $data, 'success' => true], 200);
    }
    public function completePayment(Request $request, $id)
    {
        $data = BookingMaster::find($id);
        $data->update($request->all());
        if ($data['payment_method'] === 'Strip') {
            $cur = AdminSetting::first()->currency;
            try {
                $res = (new StripeController)->makePayment($data['amount'], $data['payment_token'], $cur);
                // return $res;
                if ($res['status']) {
                    $data->update(['payment_token' => $res['charge_id']]);
                } else {
                    return response()->json(['msg' => 'Something went wrong.', 'data' => $data, 'success' => false], 200);
                }
            } catch (\Throwable $th) {
                // throw  $th;
                return response()->json(['msg' => 'Something went wrong.', 'data' => $data, 'success' => false], 200);
            }
        }
        return response()->json(['msg' => 'Thanks for payment, Payment Complete..', 'data' => $data, 'success' => true], 200);
    }
    public function future()
    {
        # code...

    }

    public function completeBooking(Request $request, $id)
    {

        $data = BookingMaster::find($id);
        $data->update($request->all());
        $ids['user_id'] = $data['user_id'];
        $ids['shop_id'] = $data['shop_id'];
        $ids['owner_id'] = $data['owner_id'];
        $ids['start_time'] = $data['start_time'];
        $ids['bid'] = $data['id'];
        $ids['booking_id'] = $data['booking_id'];
        $ids['employee_id'] = $data['employee_id'];
        $ids['address'] = $data['address'];
        try {
            $res = (new StaticNotiController)->baseNotification($ids, 7);
            //code...
        } catch (\Throwable $th) {
            //  throw $th;
        }
        try {
            $res = (new StaticNotiController)->baseNotification($ids, 9);
            //code...
        } catch (\Throwable $th) {
            //  throw $th;
        }
        $reqData['admin_share'] = ($data['admin_per'] / 100) * $data['amount'];
        $reqData['owner_share'] = $data['amount'] - $reqData['admin_share'];
        $reqData['owner_id'] = $data['owner_id'];
        $reqData['booking_id'] = $data['id'];
        $reqData['payment'] = $data['payment_method'] === 'Offline' ? 1 : 0;
        PaymentTransaction::create($reqData);
        return response()->json(['msg' => 'Thanks Booking is Complete..', 'data' => $data, 'success' => true], 200);
    }

    public function toggleOfflinePaymentStatus($id) {
        $data = BookingMaster::where('id', $id)
            ->where(function($q) {
                $q->where('payment_method', 'Offline')
                    ->orWhere('payment_method', 'offline');
            })
            ->where(function($q) {
                $q->where('employee_id', auth('shopEmployee')->user()->id)
                    ->orWhere('owner_id',  auth('shopOwner')->user()->id);
            })
            ->first();
        if (!$data){
            return response()->json(['msg' => 'Booking not found', 'success' => false], 404);
        }
        $data->payment_status = $data->payment_status == 0 ? 1 : 0;
        $string = 'Marked as ' . ($data->payment_status == 0 ? 'Unpaid' : 'Paid');
        $data->save();
        return response()->json(['msg' => $string, 'success' => true], 200);
    }
}
