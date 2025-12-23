<?php

namespace App\Http\Controllers\ShopOwner;

use App\AdminSetting;
use App\AppUsers;
use App\Http\Controllers\Admin\TwilioController;
use App\Http\Controllers\Controller;
use App\OwnerShop;
use App\ShopOwner;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ShopOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        abort_if(Gate::denies('appuser_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $owner = ShopOwner::all();
        return view('admin.shopOwner.index', compact('owner'));
    }

    public function changeStatus($id)
    {
        abort_if(Gate::denies('appuser_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = ShopOwner::findOrFail($id);
        $data->status = $data->status === 1 ? 0 : 1;
        $data->update();
        return redirect()->back()->withStatus(__('Status Is changed.'));
    }
    public function changePopular($id)
    {
        abort_if(Gate::denies('appuser_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = OwnerShop::findOrFail($id);
        $data->is_popular = $data->is_popular === 1 ? 0 : 1;
        $data->update();
        return redirect()->back()->withStatus(__('Status Is changed.'));
    }
    public function changeBest($id)
    {
        abort_if(Gate::denies('appuser_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = OwnerShop::findOrFail($id);
        $data->is_best = $data->is_best === 1 ? 0 : 1;
        $data->update();
        return redirect()->back()->withStatus(__('Status Is changed.'));
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

    /**
     * Display the specified resource.
     *
     * @param  \App\ShopOwner  $shopOwner
     * @return \Illuminate\Http\Response
     */
    public function show(ShopOwner $id)
    {
        //
        $id->load('shop');
        $shop = $id->shop;
        return view('admin.shopOwner.shop', compact('shop'));
    }
    public function shopDetail($id)
    {
        # code...
        $data = OwnerShop::find($id)->setAppends(['serviceData', 'employeeData']);
        $data->load(['reviews', 'bookings.user', 'bookings.employee']);
        return view('admin.shopOwner.singleShop', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShopOwner  $shopOwner
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopOwner $shopOwner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShopOwner  $shopOwner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopOwner $shopOwner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShopOwner  $shopOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopOwner $shopOwner)
    {
        //
    }

    public function login(Request $request)
    {
        //
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        $user = ShopOwner::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            if ($user['verified'] != 1) {
                return response()->json(['msg' => 'Please Verify your account', 'data' => null, 'success' => false, 'verification' => true], 200);
            }
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
            return response()->json(['msg' => 'Welcome back to CarQ.', 'data' => $user, 'success' => true], 200);
        } else {
            return response()->json(['msg' => 'Email and Password not match with our record', 'data' => null, 'success' => false], 200);
        }
    }
    public function store(Request $request)
    {
        //
        $request->validate([
            'email' => 'bail|required|email|unique:shop_owner,email','name' => 'bail|required',
            'password' => 'bail|required|min:6',
            'phone_no' => [
                'bail',
                'required',
                'unique:shop_owner,phone_no',
                'regex:/^\+\d{1,3}\d{7,}$/'
            ],
        ], [
            'phone_no.required' => 'The phone number is required.',
            'phone_no.unique' => 'This phone number is already registered.',
            'phone_no.regex' => 'The phone number must start with a country code (e.g., +1, +91) and contain valid digits.',
        ]);
        $reqData = $request->all();

        $app = AdminSetting::get(['id', 'verification', 'sms_gateway'])->first();
        $flow = $app->verification == 1 ? 'verification' : 'home';
        if ($app->verification != 1) {
            $reqData['verified'] = 1;
        } else {
            try {
                $res = (new TwilioController)->sendOTPUser($request, $app->sms_gateway, 'verification', 1);
                if ($res['success'] === true) {
                    $reqData['otp'] = $res['otp'];
                }
            } catch (\Exception $e) {
                $reqData['verified'] = 1;
                $reqData['otp'] = '0000';
            }
        }
        $data = ShopOwner::create($reqData);
        if ($app->verification != 1) {
            $token = $data->createToken('user')->accessToken;
            $data['token'] = $token;
        }
        return response()->json(['msg' => 'Welcome...', 'data' => $data, 'success' => true, 'flow' => $flow], 200);
    }
    public function verifyMe(Request $request)
    {
        $request->validate([
            'phone_no' => 'bail|required',
        ]);
        if ($request->type == '1') {
            $userData = ShopOwner::Where([['phone_no', $request->phone_no]])->first();
        } else {

            $userData = AppUsers::Where([['phone_no', $request->phone_no]])->first();
        }

        if ($userData && $userData['verified'] === 1) {
            return response()->json(['msg' => 'You already verify ', 'data' => null, 'success' => false, 'redirect' => 'login'], 200);
        } elseif ($userData && $userData['verified'] != 1) {

            if ($userData['otp'] === $request->otp) {
                $userData->otp = '';
                $userData->verified = 1;
                $userData->save();
                $token = $userData->createToken('user')->accessToken;
                $userData['token'] = $token;
                return response()->json(['msg' => 'Thanks For being With us', 'data' => $userData, 'success' => true], 200);
            }

            return response()->json(['msg' => 'OTP is Invalid', 'data' => $userData, 'success' => false], 200);
        } else {
            return response()->json(['msg' => 'Email and number are attached with different account', 'data' => null, 'success' => false, 'redirect' => 'login'], 200);
        }
    }
}
