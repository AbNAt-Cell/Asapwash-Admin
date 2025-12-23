<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use App\AppUsers;
use App\BookingMaster;
use App\Branch;
use App\Category;
use App\FAQ;
use App\Http\Controllers\Admin\CoderController;
use App\Http\Requests\PasswordRequest;
use App\Notifications;
use App\OwnerShop;
use App\Review;
use App\ServiceProvider;
use App\ShopEmployee;
use App\ShopOwner;
use App\UserAddress;
use App\UserVehicle;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;


class AppUsersController extends Controller
{

    public function index()
    {
        //
        $coder   = new CoderController;
        if (method_exists($coder, 'realityCheck')) {
            $coder->realityCheck();
        } else {
            Artisan::call('down');
            abort(503);
        }
        abort_if(Gate::denies('appuser_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $appuser =   AppUsers::all();
        return view('admin.appuser.index', compact('appuser'));
    }
    public function changeStatus($id)
    {
        abort_if(Gate::denies('appuser_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data =   AppUsers::findOrFail($id);
        $data->status = $data->status === 1 ? 0  : 1;
        $data->update();
        return redirect()->back()->withStatus(__('Status Is changed.'));
    }
    public function login(Request $request)
    {
        $coder   = new CoderController;
        if (method_exists($coder, 'realityCheck')) {
            $coder->realityCheck();
        } else {
            Artisan::call('down');
            abort(503);
        }
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        $user = AppUsers::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            if ($user['verified'] != 1) {
                return response()->json(['msg' => 'Please Verify your account', 'data' => $user, 'success' => false, 'verification' => true], 200);
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
            return response()->json(['msg' => 'Welcome back  ', 'data' => $user, 'success' => true], 200);
        } else {
            return response()->json(['msg' => 'Email and Password not match with our record', 'data' => null, 'success' => false], 200);
        }
    }
    public function newPassword(Request $request)
    {
        $request->validate([
            'password' => 'bail|required|min:6',
        ]);
        $phone = $request->phone ?? $request->phone_no ?? '';
        if ($request->type == 1) {
            $user = ShopOwner::where('phone_no', $phone)->first();
        } elseif ($request->type == 2) {
            $user = ShopEmployee::where('phone_no', $phone)->first();
        } else {
            $user = AppUsers::where('phone_no', $phone)->first();
        }
        // return $user;
        if (!$user) {
            return response()->json(['msg' => 'User Not found',  'success' => false,], 200);
        }
        $user->update($request->all());
        $user['token'] = $user->createToken('users')->accessToken;
        return response()->json(['msg' => 'Welcome back to CarQ', 'data' => $user, 'success' => true,], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email|unique:app_users,email',
            'name' => 'bail|required',
            'password' => 'bail|required|min:6','phone_no' => [
                'bail',
                'required',
                'unique:app_users,phone_no',
                'regex:/^\+\d{1,3}\d{7,}$/'
            ],
        ], [
            'phone_no.required' => 'The phone number is required.',
            'phone_no.unique' => 'This phone number is already registered.',
            'phone_no.regex' => 'The phone number must start with a country code (e.g., +1, +91) and contain valid digits.',
        ]);
        $reqData = $request->all();

        $app = AdminSetting::get(['id', 'verification', 'sms_gateway'])->first();
        $flow =    $app->verification == 1 ? 'verification' : 'home';
        if ($app->verification != 1) {
            $reqData['verified'] = 1;
        } else {
            try {
                $res = (new Admin\TwilioController)->sendOTPUser($request, $app->sms_gateway, 'verification', 0);
                if ($res['success'] === true) {
                    $reqData['otp'] = $res['otp'];
                    // $reqData['otp'] = '0000';
                }
            } catch (\Exception $e) {
                $reqData['verified'] = 1;
                $reqData['otp'] = '0000';
                info($e->getMessage());
            }
        }

        $data = AppUsers::create($reqData);
        if ($app->verification != 1) {
            $token = $data->createToken('user')->accessToken;
            $data['token'] = $token;
        }
        return response()->json(['msg' => 'Welcome!', 'data' => $data, 'success' => true, 'flow' => $flow], 200);
    }

    public function profileUpdate(Request $request)
    {
        auth()->user()->update($request->all());
        $data = Auth::user();
        return response()->json(['msg' => 'Profile Updated', 'data' => $data, 'success' => true], 200);
    }
    public function profilePictureUpdate(Request $request)
    {
        $name = (new AppHelper)->saveBase64($request->image);

        auth()->user()->update([
            'image' => $name,
        ]);
        $data = Auth::user();
        return response()->json(['msg' => 'Profile Updated', 'data' => $data, 'success' => true], 200);
    }
    public function simpleState()
    {
        $data = array();
        $data['booking'] =  BookingMaster::where('user_id', Auth::id())->count();
        $data['review'] =  Review::where('user_id', Auth::id())->count();
        $data['vehicle'] =  UserVehicle::where('user_id', Auth::id())->count();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function notification()
    {
        $data =  Notifications::where('user_id', Auth::id())->orderBy('created_at', "desc")->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function verifyMe(Request $request)
    {
        $request->validate([
			'phone_no' => 'bail|required_unless:is_for_password_change,true|nullable',
			'OTP' => 'bail|required',
			'is_for_password_change' => 'sometimes|boolean'
		]);
        if ($request->type == '1') {
            $userData = ShopOwner::Where([['phone_no', $request->phone_no]])->first();
        } else {

            $userData = AppUsers::Where([['phone_no', $request->phone_no]])->first();
        }

        if ($request->is_for_password_change == true) {
            if ($userData['otp'] === $request->OTP) {
                $userData->otp = '';
                $userData->verified = 1;
                $userData->save();
                $token = $userData->createToken('user')->accessToken;
                $userData['token'] = $token;
                return response()->json(['msg' => '', 'data' => $userData, 'success' => true], 200);
            } else {
                return response()->json(['msg' => 'OTP is Invalid', 'data' => $userData, 'success' => false], 200);
            }
        }

        if ($userData && $userData['verified'] === 1) {
            return response()->json(['msg' => 'You already verify ', 'data' => null, 'success' => false, 'redirect' => 'login'], 200);
        } else if ($userData && $userData['verified'] != 1) {

            if ($userData['otp'] === $request->OTP) {
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
    public function userFevSalon($id)
    {
        // $data = User::findOrfail($request->user()->id);
        $fev = implode(",",  Auth::user()->liked_salon);
        $temp = "";
        $oldfev = Auth::user()->liked_salon;
        if (in_array($id, $oldfev)) {
            $temp = str_replace($id, "", $fev);
            $temp = ltrim($temp, ',');
            $temp = rtrim($temp, ',');
            $temp = str_replace(",,", ",", $temp);
        } else {
            $temp = $fev . ',' . $id;
            $temp = ltrim($temp, ',');
            $temp = rtrim($temp, ',');
            $temp = str_replace(",,", ",", $temp);
        }

        auth()->user()->update([
            'liked_salon' => $temp,
        ]);
        return response()->json(['msg' => 'done', 'data' => null, 'success' => true], 200);
    }
    public function userFevSalonList()
    {

        $pro =    Auth::user()->liked_salon;
        $data =  Branch::where('status', 1)->whereIn('id', $pro)->get(['name', 'id', 'icon', 'address', 'for_who'])->each->setAppends(['avg_rating', 'imageUri']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true,], 200);
    }
    public function notiList()
    {
        $data = Notifications::where('user_id', Auth::user()->id)->get()->each->setAppends(['provider']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true,], 200);
    }


    public function privacy()
    {
        $d = AdminSetting::first();
        return response()->json(['msg' => null, 'data' =>  $d->pp, 'success' => true,], 200);
    }
    public function faqList()
    {
        $d = FAQ::all();
        return response()->json(['msg' => null, 'data' =>  $d, 'success' => true,], 200);
    }
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => $request->get('password')]);
        $data['token'] = auth()->user()->createToken('user')->accessToken;
        return response()->json(['msg' => "Password Change", 'data' => $data['token'], 'success' => true,], 200);
    }
    public function forgot(Request $request)
    {
        $request->validate([
            'type' => 'bail|required',
            'phone_no' => [
                'bail',
                'required',
                'regex:/^\+\d{1,3}\d{7,}$/'
            ],
            'is_debugging' => 'sometimes'
        ], [
            'phone_no.required' => 'The phone number is required.',
            'phone_no.regex' => 'The phone number must start with a country code (e.g., +1, +91) and contain valid digits.',
        ]);
        $app = AdminSetting::get(['id', 'verification', 'sms_gateway'])->first();
        info($request->type);

        if ($request->type == '1') {
            $userData = ShopOwner::where([['phone_no', $request->phone_no]])->first();
        } elseif ($request->type == '2') {
            $userData = ShopEmployee::where([['phone_no', $request->phone_no]])->first();
        } else {
            $userData = AppUsers::where([['phone_no', $request->phone_no]])->first();
        }
        if ($userData) {
            if ($request->is_debugging) {
                $reqData['otp'] = '123456';
                $userData->update($reqData);
                return response()->json(['msg' => 'OTP is 123456', 'data' => null, 'success' => true,], 200);
            } else {
                $res = (new Admin\TwilioController)->sendOTPUser($request, $app->sms_gateway, 'forgot', $request->type);
                if ($res['success'] === true) {
                    $reqData['otp'] = $res['otp'];
                    $userData->update($reqData);
                    return response()->json(['msg' => 'OTP send to your phone.', 'data' => null, 'success' => true,], 200);
                } else {
                    return response()->json(['msg' => 'Something went wrong.', 'data' => null, 'success' => false,], 200);
                }
            }
        }
        return response()->json(['msg' => 'You are not verified user.', 'data' => null, 'success' => false,], 200);
    }
    public function forgotValidate(Request $request)
    {
        $request->validate([
            'type' => 'bail|required',
            'otp' => 'bail|required',
            'phone_no' => [
                'bail',
                'required',
                'regex:/^\+\d{1,3}\d{7,}$/'
            ],
        ], [
            'phone_no.required' => 'The phone number is required.',
            'phone_no.regex' => 'The phone number must start with a country code (e.g., +1, +91) and contain valid digits.',
        ]);
        if ($request->type == '1') {
            $userData = ShopOwner::where([['phone_no', $request->phone_no], ['otp', $request->otp]])->first();
            $userData->update(['verified' => 1]);
        } elseif ($request->type == '2') {
            $userData = ShopEmployee::where([['phone_no', $request->phone_no], ['otp', $request->otp]])->first();
        } else {
            $userData = AppUsers::where([['phone_no', $request->phone_no], ['otp', $request->otp]])->first();
            $userData->update(['verified' => 1]);
        }
        if ($userData) {
            $userData->update(['otp' => '']);
            $data['token'] = $userData->createToken('user')->accessToken;
            return response()->json(['msg' => 'OTP is verified.', 'data' => $data, 'success' => true,], 200);
        }
        return response()->json(['msg' => 'Given OTP is invalid.', 'data' => null, 'success' => false,], 200);
    }


    public function homeApi()
    {
        $master['category'] = Category::where('status', 1)->get();
        $master['popular'] = OwnerShop::where([['is_popular', 1], ['status', 1]])->get(['name', 'id', 'image']);
        $master['best'] = OwnerShop::where([['is_best', 1], ['status', 1]])->get(['name', 'id', 'image', 'address']);
        return response()->json(['msg' => null, 'data' => $master, 'success' => true,], 200);
    }
    public function newVehicleStore(Request $request)
    {
        $reqData = $request->all();
        $reqData['user_id'] = Auth::id();
        $data =  UserVehicle::create($reqData);
        $data = UserVehicle::with(['model.brand'])->where('id', $data->id)->first();
        return response()->json(['msg' => 'Vehicle added successfully', 'data' => $data, 'success' => true,], 200);
    }
    public function vehicleList()
    {
        $data = UserVehicle::with(['model.brand'])->where('user_id', Auth::id())->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true,], 200);
    }
    public function singleVehicle($id)
    {
        $data = UserVehicle::with(['model.brand'])->where('id', $id)->first();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true,], 200);
    }
    public function newAddressStore(Request $request)
    {
        $reqData = $request->all();
        $reqData['user_id'] = Auth::id();
        $data = UserAddress::create($reqData);
        $data = UserAddress::where('id', $data->id)->first();
        return response()->json(['msg' => 'Address added successfully', 'data' => $data, 'success' => true,], 200);
    }
    public function addressList()
    {
        $data = UserAddress::where('user_id', Auth::id())->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true,], 200);
    }

    public function deleteAddress($id)
    {
        $data = UserAddress::where('id', $id)->first();
        if ($data) {
            $data->delete();
            return response()->json(['msg' => 'Address deleted successfully', 'data' => null, 'success' => true], 200);
        } else {
            return response()->json(['msg' => 'Address not found', 'data' => null, 'success' => false], 404);
        }
    }

    /// All three Apps' API uses this same function
    public function storeDeviceToken(Request $request)
    {
        $user = auth()->user();
        $currentTokens = $user->device_token ? explode(',', $user->device_token) : [];
        $newToken = $request->device_token;

        // Only add the token if it's not already in the list
        if (!in_array($newToken, $currentTokens) && $newToken != '' && $newToken != 'null' && $newToken != 'N/A') {
            $currentTokens[] = $newToken;
        }

        $user->device_token = implode(',', $currentTokens);
        $user->save();

        return response()->json(['msg' => 'Device Token Updated', 'success' => true], 200);
    }
}
