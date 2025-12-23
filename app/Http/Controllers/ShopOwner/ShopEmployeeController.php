<?php


namespace App\Http\Controllers\ShopOwner;

use App\AdminSetting;
use App\BookingMaster;
use App\Http\Controllers\Admin\StaticNotiController;
use App\Http\Controllers\AppHelper;
use App\Http\Controllers\Controller;
use App\Notifications;
use App\ShopEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShopEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data =   ShopEmployee::withCount(['reviews', 'booking'])->where('owner_id', Auth::id())->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'email' => 'bail|required|email|unique:shop_employee,email',
            'name' => 'bail|required','password' => 'bail|required|min:6',
            'start_time' => 'bail|required',
            'end_time' => 'bail|required',
            'phone_no' => [
                'bail',
                'required',
                'unique:shop_employee,phone_no',
                'regex:/^\+\d{1,3}\d{7,}$/'
            ],
        ], [
            'phone_no.required' => 'The phone number is required.',
            'phone_no.unique' => 'This phone number is already registered.',
            'phone_no.regex' => 'The phone number must start with a country code (e.g., +1, +91) and contain valid digits.',
        ]);
        $reqData = $request->all();

        if (isset($reqData['image'])) {
            $reqData['image'] = (new AppHelper)->saveBase64($reqData['image']);
        }
        $reqData['owner_id'] = Auth::id();
        $data = ShopEmployee::create($reqData);
        return response()->json(['msg' => 'Employee added successfully', 'data' => $data, 'success' => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShopEmployee  $shopEmployee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = ShopEmployee::find($id)->setAppends(['imageUri', 'avgRating']);
        $data['currency'] =AdminSetting::first()->currency_symbol;
        $data->load(['booking.user', 'reviews']);
        return response()->json(['msg' => null, 'data' =>  $data, 'success' => true], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShopEmployee  $shopEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopEmployee $shopEmployee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShopEmployee  $shopEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $reqData = $request->all();

        if (isset($reqData['image'])) {
            $reqData['image'] = (new AppHelper)->saveBase64($reqData['image']);
        }
        ShopEmployee::find($id)->update($reqData);
        $data = ShopEmployee::find($id);
        return response()->json(['msg' => 'Employee  update successfully', 'data' => $data, 'success' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShopEmployee  $shopEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopEmployee $shopEmployee)
    {
        //
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        $user = ShopEmployee::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // if ($user['verified'] != 1) {
            //     return response()->json(['msg' => 'Please Verify your account', 'data' => null, 'success' => false, 'verification' => true], 200);
            // }
            if ($user['status'] == 0) {
                return response()->json(['msg' => 'You are block by admin', 'data' => null, 'success' => false], 200);
            }
            $token = $user->createToken('user')->accessToken;
            $currentTokens = $user->device_token ? explode(',', $user->device_token) : [];
            $newToken = $request->device_token;

            // Only add the token if it's not already in the list
            if (!in_array($newToken, $currentTokens)) {
                $currentTokens[] = $newToken;
            }
            $user->device_token = implode(',', $currentTokens);
            $user->save();
            $user['token'] = $token;
            return response()->json(['msg' => 'Welcome back to CarQ', 'data' => $user, 'success' => true], 200);
        } else {
            return response()->json(['msg' => 'Email and Password not match with our record', 'data' => null, 'success' => false], 200);
        }
    }
    public function employeeReview(Request $request)
    {
        $user =   ShopEmployee::find(Auth::id())->load('reviews');
        return response()->json(['msg' => null, 'data' =>  $user['reviews'], 'success' => true], 200);
    }
    public function booking()
    {
        $data = BookingMaster::with(['user:id,name,image'])->where([['employee_id', Auth::id()]])->get(['id', 'start_time', 'end_time', 'status', 'address', 'shop_id', 'vehicle_id', 'service_type', 'booking_id', 'user_id', 'amount']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    public function singleBooking($id)
    {
        $data= BookingMaster::with(['user:id,name,image,address', 'model.model.brand','Shop','Employee'])->where('id', $id)->get()->first()->setAppends(['serviceData', 'currency']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function bookingFilleter(Request $request)
    {
        $data = BookingMaster::with(['user:id,name,image'])->where([['employee_id', Auth::id()]])->whereBetween('start_time', [$request->from, $request->to])->get(['id', 'start_time', 'end_time', 'status', 'service_type', 'booking_id', 'user_id', 'amount', 'address']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function approvedBooking(Request $request, $id)
    {
        // approved // rejected booking

        $data =   BookingMaster::find($id);
        $data->update($request->all());
        $ids['user_id'] = $data['user_id'];
        $ids['shop_id'] = $data['shop_id'];
        $ids['owner_id'] = $data['owner_id'];
        $ids['start_time'] = $data['start_time'];
        $ids['bid'] = $data['id'];
        $ids['booking_id'] = $data['booking_id'];
        $ids['employee_id'] = $data['employee_id'];
        $ids['address'] = $data['address'];
        if ($request->status == '5') {
            //rejected
            try {
                $res = (new StaticNotiController)->baseNotification($ids, 6);
            } catch (\Exception $e) {
                info($e);
            }
            return response()->json(['msg' => 'Booking is rejected', 'data' => null, 'success' => true], 200);
        } elseif ($request->status == '1') {
            // accpecte
            try {
                $res = (new StaticNotiController)->baseNotification($ids, 3);
            } catch (\Exception $e) {
                info($e);
            }
            try {
                $res = (new StaticNotiController)->baseNotification($ids, 8);
            } catch (\Exception $e) {
                info($e);
            }
            return response()->json(['msg' => 'Booking Successfully accepted', 'data' => null, 'success' => true], 200);
        }
    }
    public function notification()
    {
        $data =  Notifications::where('emp_id', Auth::id())->orderBy('created_at', "desc")->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
}
