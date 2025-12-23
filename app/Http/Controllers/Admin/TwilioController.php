<?php

namespace App\Http\Controllers\Admin;

use App\AdminSetting;
use App\AppUsers;
use App\Http\Controllers\Controller;
use App\ShopOwner;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class TwilioController extends Controller
{
    //
    public function index()
    {
        # code...
        $account_sid = env("TWILIO_SID");
        $auth_token = env("TWILIO_AUTH_TOKEN");
        $twilio_number = env("TWILIO_NUMBER_WP");

        $twilio = new Client($account_sid, $auth_token);

        $message = $twilio->messages
            ->create(
            "whatsapp:+1___________", // to number
                [
                    "from" => "whatsapp:" . $twilio_number,
                    "body" => "Hello there!",
                ]
            );
    }
    public function sendOTPUser(Request $request, $gateway, $type = 'verification', $userType)
    {

        if ($userType == 0) {
            $userData = AppUsers::Where([['phone_no', $request->phone_no]])->first();
        } elseif ($userType == 2) {
            $userData = ShopOwner::Where([['phone_no', $request->phone_no]])->first();
        } else {
            $userData = ShopOwner::Where([['phone_no', $request->phone_no]])->first();
        }

        if ($userData && $userData['verified'] === 1 && $type === 'verification') {
            return ['otp' => '', 'success' => false];
        } else {

            $string = '0123456789';
            $string_shuffled = str_shuffle($string);
            $otp = substr($string_shuffled, 1, 4);
            $message = $otp . ' your verification code for ' . env('APP_NAME');

            if ($gateway === 'twilio') {
                $this->twilio($request->phone_no, $message);
            } else {
                $this->textLocal($request->phone_no, $message);
            }

            return ['otp' => $otp, 'success' => true];
        }
    }
    private function textLocal($ph, $message)
    {
        try {
            //code...

            $apiKey = urlencode(env("TEXT_LOCAL_API"));
            $numbers = array(918487013103);
            $sender = urlencode('TXTLCL');
            $message = rawurlencode($message);
            $numbers = implode(',', $numbers);
            $ph = '91' . $ph;
            $data = array('apikey' => $apiKey, 'numbers' => $ph, 'sender' => $sender, 'message' => $message);
            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
        } catch (\Throwable $th) {
            //throw $th;

        }
    }
    private function twilio($ph, $message)
    {
        try {
            $d = AdminSetting::get(['country_code'])->first();
            $account_sid = env("TWILIO_SID");
            $auth_token = env("TWILIO_AUTH_TOKEN");
            $twilio_number = $d['country_code'] . env("TWILIO_NUMBER");
            $client = new Client($account_sid, $auth_token);
            $client->messages->create(
                $ph,
                ['from' => $twilio_number, 'body' => $message]
            );
        } catch (\Exception $e) {
            info($e->getMessage());
        }
    }
    public function updateTwilio(Request $request)
    {
        $data = [
            'TWILIO_SID' => $request->TWILIO_SID,
            'TWILIO_AUTH_TOKEN' => $request->TWILIO_AUTH_TOKEN,
            'TWILIO_NUMBER' => $request->TWILIO_NUMBER,
            'TEXT_LOCAL_API' => $request->TEXT_LOCAL_API,
        ];
        //  country_code
        try {
            (new AdminSettingController)->updateENV($data);
        } catch (\Throwable $th) {
        }

        $verification = 0;
        if ($request->verification == '1') {
            $verification = 1;
        } else {

            $verification = 0;
        }
        $pp = AdminSetting::get()->first();
        $pp->country_code = $request->country_code;
        $pp->sms_gateway = $request->sms_gateway;
        $pp->verification = $verification;
        $pp->update();
        // return "true";
        return redirect('setting')->withStatus(__('Twilio Configuration updated successfully.'));
    }

}
